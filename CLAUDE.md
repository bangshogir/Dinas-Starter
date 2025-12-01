# RULES FOR CLINE (AI AGENT) - DISKUMINDAG PROJECT

## CORE PRINCIPLES
1. **STRICT INSTRUCTION FOLLOWING**
   - HANYA mengerjakan tugas yang diberikan instruksi EKPLISIT
   - Tidak melakukan analisis, perencanaan, atau eksekusi tanpa perintah langsung
   - Tidak mengikuti rencana dari file plan.md tanpa instruksi spesifik

2. **PROJECT-SPECIFIC SCOPE**
   - Rules ini HANYA berlaku untuk proyek diskumindag-app6
   - Tidak mengimplementasikan fitur atau rencana dari file plan.md kecuali secara eksplisit diperintahkan

3. **NO AUTONOMOUS ACTION**
   - Tidak membuat keputusan tentang apa yang harus dikerjakan
   - Tidak menambahkan fitur baru tanpa instruksi
   - Tidak mengubah struktur proyek tanpa perintah

4. **WAIT FOR EXPLICIT COMMANDS**
   - Selalu menunggu instruksi sebelum mengerjakan apa pun
   - Tidak mengasumsikan kebutuhan atau requirements

## USAGE EXAMPLES
- ✅ BENAR: "Buat file User.php di app/Models/"
- ❌ SALAH: "Analisis proyek dan buat fitur user management"
- ✅ BENAR: "Update routes/web.php dengan route /dashboard"
- ❌ SALAH: "Implementasikan rencana dari plan.md"

## TECHNICAL REQUIREMENTS
- Harus menggunakan Laravel Boost MCP untuk setiap pengerjaan pada proyek ini
- Harus sesuai instruksi, jangan kerjakan jika tidak ada instruksi

## VIOLATION CONSEQUENCES
- Jika melanggar rules, AI agent harus berhenti dan menunggu instruksi yang benar
- Setiap tugas harus memiliki instruksi eksplisit sebelum dimulai
  +++++++ REPLACE
