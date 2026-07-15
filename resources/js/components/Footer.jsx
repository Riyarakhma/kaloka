import { Leaf, MapPin, Phone, Mail } from 'lucide-react';

export default function Footer() {
    return (
        <footer className="mt-24 border-t border-border bg-primary text-primary-foreground">
            <div className="container-page grid gap-10 py-12 md:grid-cols-3">
                <div>
                    <div className="flex items-center gap-3">
                        <div className="grid size-11 place-items-center rounded-2xl bg-primary-foreground/15">
                            <Leaf className="size-6" />
                        </div>
                        <div>
                            <div className="font-display text-2xl font-bold">KALOKA</div>
                            <div className="text-sm opacity-80">Kearifan & Literasi Lokal</div>
                        </div>
                    </div>
                    <p className="mt-4 text-base leading-relaxed opacity-90">
                        Portal informasi Perpustakaan Desa Sobokerto — merawat kearifan
                        lokal, menghubungkan warga dengan pengetahuan.
                    </p>
                </div>
                <div>
                    <h3 className="font-display text-lg font-semibold text-primary-foreground">
                        Kontak Perpustakaan
                    </h3>
                    <ul className="mt-4 space-y-3 text-base opacity-90">
                        <li className="flex items-start gap-3">
                            <MapPin className="mt-1 size-5 shrink-0" />
                            <span>
                                Desa Sobokerto, Kec. Ngemplak,<br />Kab. Boyolali, Jawa Tengah
                            </span>
                        </li>
                        <li className="flex items-center gap-3">
                            <Phone className="size-5 shrink-0" />
                            <span>(0276) 000-0000</span>
                        </li>
                        <li className="flex items-center gap-3">
                            <Mail className="size-5 shrink-0" />
                            <span>perpus.sobokerto@desa.id</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 className="font-display text-lg font-semibold text-primary-foreground">
                        Kerja Sama
                    </h3>
                    <ul className="mt-4 space-y-2 text-base opacity-90">
                        <li>Pemerintah Desa Sobokerto</li>
                        <li>Dinas Kearsipan & Perpustakaan Provinsi Jawa Tengah</li>
                        <li>KKN Tematik Mahasiswa</li>
                    </ul>
                </div>
            </div>
            <div className="border-t border-primary-foreground/15">
                <div className="container-page py-5 text-center text-sm opacity-80">
                    © {new Date().getFullYear()} KALOKA — Perpustakaan Desa Sobokerto.
                </div>
            </div>
        </footer>
    );
}