<div>
    {{-- Hero --}}
    <section class="bg-gradient-to-br from-brand/light via-white to-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                    Solusi Agrochemical
                    <span class="text-brand">Profesional</span>
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Pupuk, pestisida, formulasi industri untuk perkebunan skala besar.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ url('/products') }}"
                       class="inline-flex items-center px-5 py-3 rounded-xl bg-brand text-white font-semibold shadow hover:bg-brand-dark transition">
                        Lihat Produk
                    </a>

                    <a href="{{ url('/contact') }}"
                       class="inline-flex items-center px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold shadow hover:bg-gray-50 transition">
                        Hubungi Tim Teknis
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6">
                    <p class="text-xs uppercase tracking-wide text-gray-500 font-medium">
                        Sertifikasi & Compliance
                    </p>
                    <ul class="mt-4 space-y-2 text-gray-700 text-sm leading-relaxed">
                        <li>Registrasi resmi & legalitas</li>
                        <li>Dukungan TKDN & dokumen teknis</li>
                        <li>Custom formulation untuk kebutuhan pabrik</li>
                    </ul>
                </div>

                <div class="absolute -bottom-6 -right-6 w-24 h-24 rounded-xl bg-brand/20 blur-2xl"></div>
            </div>
        </div>
    </section>

    {{-- Product grid preview --}}
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Produk Unggulan</h2>
                <p class="text-gray-600 text-sm mt-1">Formulasi stabil, konsisten, siap skala industri.</p>
            </div>
            <a href="{{ url('/products') }}" class="text-brand font-medium text-sm hover:text-brand-dark">
                Lihat semua &rarr;
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow ring-1 ring-black/5 p-6 flex flex-col">
                <div class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Insecticide
                </div>
                <div class="mt-2 text-lg font-semibold text-gray-900">
                    Fipronil Tech
                </div>
                <p class="mt-2 text-sm text-gray-600 flex-1">
                    Bahan aktif insektisida kontak & racun perut. Stabilitas tinggi untuk lini perkebunan.
                </p>
                <div class="mt-4 text-sm text-gray-500">
                    TKDN support • COA available
                </div>
            </div>

            {{-- dst / loop kategori real nanti --}}
        </div>
    </section>
</div>
