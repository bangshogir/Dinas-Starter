# CRITICAL #2: WYSIWYG Editor Integration Plan

## 🎯 Objective
Integrate TinyMCE editor untuk content editing yang rich dan user-friendly.

## ⏱️ Estimasi: 1 jam

## 🤔 Why TinyMCE?

### Advantages
- ✅ Free & open source
- ✅ Easy integration (CDN available)
- ✅ Rich features (images, tables, links, code)
- ✅ Customizable toolbar
- ✅ Good documentation
- ✅ Active community
- ✅ No npm install needed
- ✅ Image upload support
- ✅ Dark mode support

### Alternatives Considered
- CKEditor (more complex setup)
- Quill (limited features)
- Summernote (outdated)

## 📝 Implementation Steps

### Step 1: Add TinyMCE CDN (5 min)

**File:** `resources/views/admin/articles/create.blade.php` & `edit.blade.php`

Add before closing `</body>` or in `@push('scripts')`:

```blade
@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
            'preview', 'anchor', 'searchreplace', 'visualblocks', 'code',
            'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                 'alignleft aligncenter alignright alignjustify | ' +
                 'bullist numlist outdent indent | link image | ' +
                 'forecolor backcolor | removeformat | code fullscreen',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; line-height: 1.6; }',
        
        // Image upload configuration
        images_upload_url: '{{ route("admin.articles.upload-image") }}',
        automatic_uploads: true,
        file_picker_types: 'image',
        
        // CSRF token for image upload
        images_upload_handler: function (blobInfo, success, failure) {
            let xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("admin.articles.upload-image") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            
            xhr.onload = function() {
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                let json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
    });
</script>
@endpush
```

### Step 2: Update Content Textarea (2 min)

Replace plain textarea with:

```blade
<div>
    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
        Konten <span class="text-error-500">*</span>
    </label>
    <textarea name="content" id="content" required>{{ old('content', $article->content ?? '') }}</textarea>
    @error('content')
        <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
    @enderror
</div>
```

### Step 3: Create Image Upload Route (5 min)

**File:** `routes/web.php`

Add inside admin articles group:

```php
Route::post('admin/articles/upload-image', [ArticleController::class, 'uploadImage'])
    ->middleware(['auth', 'permission:articles.create'])
    ->name('admin.articles.upload-image');
```

### Step 4: Add Upload Method to Controller (20 min)

**File:** `app/Http/Controllers/Admin/ArticleController.php`

Add method:

```php
public function uploadImage(Request $request)
{
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ]);

    try {
        $image = $request->file('file');
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('articles/content', $filename, 'public');
        
        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Upload failed: ' . $e->getMessage()
        ], 500);
    }
}
```

### Step 5: Dark Mode Support (10 min)

Update TinyMCE init to detect dark mode:

```javascript
<script>
    // Detect dark mode
    const isDarkMode = document.documentElement.classList.contains('dark');
    
    tinymce.init({
        selector: '#content',
        // ... other config
        
        // Dark mode skin
        skin: isDarkMode ? 'oxide-dark' : 'oxide',
        content_css: isDarkMode ? 'dark' : 'default',
        
        // Update on dark mode toggle
        setup: function(editor) {
            // Listen for dark mode changes
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        const isDark = document.documentElement.classList.contains('dark');
                        // Reload editor with new theme
                        tinymce.remove();
                        tinymce.init(/* config with new theme */);
                    }
                });
            });
            
            observer.observe(document.documentElement, {
                attributes: true
            });
        }
    });
</script>
```

### Step 6: Form Submit Handler (8 min)

Ensure TinyMCE content is saved before form submit:

```javascript
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        // Trigger TinyMCE to save content to textarea
        tinymce.triggerSave();
    });
</script>
```

### Step 7: Testing (15 min)

Test all features:
- Editor loads correctly
- Toolbar buttons work
- Text formatting (bold, italic, underline)
- Lists (ordered, unordered)
- Links
- Images (upload & insert)
- Tables
- Code view
- Fullscreen mode
- Content saves correctly
- Content displays correctly on show page
- Dark mode compatibility

## ✅ Acceptance Criteria

- [ ] TinyMCE loads without errors
- [ ] All toolbar buttons functional
- [ ] Text formatting works (bold, italic, etc)
- [ ] Lists work (ordered, unordered)
- [ ] Links can be inserted
- [ ] Images can be uploaded
- [ ] Images display in editor
- [ ] Tables can be created
- [ ] Code view works
- [ ] Fullscreen mode works
- [ ] Content saves to database
- [ ] Content displays correctly on frontend
- [ ] HTML is properly sanitized
- [ ] Dark mode compatible
- [ ] No console errors

## 🎨 Toolbar Configuration

### Basic Toolbar (Recommended)
```javascript
toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image'
```

### Advanced Toolbar
```javascript
toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | ' +
         'alignleft aligncenter alignright alignjustify | ' +
         'bullist numlist outdent indent | link image media table | ' +
         'forecolor backcolor | removeformat | code fullscreen help'
```

### Minimal Toolbar
```javascript
toolbar: 'bold italic | bullist numlist | link'
```

## 🔧 Advanced Configuration Options

### Custom Styles
```javascript
style_formats: [
    {title: 'Heading 1', format: 'h1'},
    {title: 'Heading 2', format: 'h2'},
    {title: 'Heading 3', format: 'h3'},
    {title: 'Paragraph', format: 'p'},
    {title: 'Blockquote', format: 'blockquote'},
    {title: 'Code', format: 'code'}
]
```

### Content Filtering
```javascript
valid_elements: 'p,br,strong,em,u,a[href|target],ul,ol,li,h1,h2,h3,h4,h5,h6,img[src|alt|width|height],table,tr,td,th,blockquote,code,pre',
extended_valid_elements: 'iframe[src|width|height|frameborder|allowfullscreen]'
```

### Paste Options
```javascript
paste_as_text: false,
paste_data_images: true,
paste_preprocess: function(plugin, args) {
    // Clean pasted content
    args.content = args.content.replace(/<span[^>]*>/g, '').replace(/<\/span>/g, '');
}
```

## 🧪 Testing Checklist

### Functionality
- [ ] Editor initializes
- [ ] Toolbar visible and clickable
- [ ] Bold text
- [ ] Italic text
- [ ] Underline text
- [ ] Strikethrough text
- [ ] Headings (H1-H6)
- [ ] Paragraphs
- [ ] Ordered list
- [ ] Unordered list
- [ ] Indent/Outdent
- [ ] Text alignment
- [ ] Insert link
- [ ] Upload image
- [ ] Insert table
- [ ] Text color
- [ ] Background color
- [ ] Code view
- [ ] Fullscreen mode
- [ ] Undo/Redo

### Integration
- [ ] Content saves on form submit
- [ ] Content loads on edit
- [ ] HTML preserved correctly
- [ ] Images display on frontend
- [ ] Links work on frontend
- [ ] Tables display correctly
- [ ] No XSS vulnerabilities

### UI/UX
- [ ] Editor height appropriate
- [ ] Responsive on mobile
- [ ] Dark mode works
- [ ] No layout breaks
- [ ] Loading state visible
- [ ] Error messages clear

## 🚨 Common Issues & Solutions

### Issue 1: Editor Not Loading
**Solution:** Check CDN connection, verify selector matches textarea ID

### Issue 2: Images Not Uploading
**Solution:** Check CSRF token, verify route exists, check file permissions

### Issue 3: Content Not Saving
**Solution:** Call `tinymce.triggerSave()` before form submit

### Issue 4: Dark Mode Not Working
**Solution:** Ensure dark class detection is correct, reload editor on theme change

### Issue 5: Toolbar Buttons Not Working
**Solution:** Verify plugins are loaded, check for JavaScript errors

## 📚 Resources

- TinyMCE Docs: https://www.tiny.cloud/docs/
- Image Upload: https://www.tiny.cloud/docs/configure/file-image-upload/
- Plugins: https://www.tiny.cloud/docs/plugins/
- Toolbar: https://www.tiny.cloud/docs/configure/editor-appearance/#toolbar
