import { Leaf, MapPin, Phone, Mail } from 'lucide-react';

export default function Footer() {
    return (
        <footer className="mt-24 border-t border-border bg-primary text-primary-foreground">
            <div className="container-page py-14">

                <div className="grid gap-12 md:grid-cols-2 md:gap-20">

                    {/* Logo & Deskripsi */}
                    <div>
                        <div className="flex items-center gap-4">
                            <div className="grid h-14 w-14 place-items-center rounded-2xl bg-primary-foreground/15">
                                <Leaf className="h-7 w-7" />
                            </div>

                            <div>
                                <h2 className="font-display text-3xl font-bold">
                                    KALOKA
                                </h2>

                                <p className="text-sm opacity-80">
                                    Kearifan & Literasi Lokal
                                </p>
                            </div>
                        </div>

                        <p className="mt-6 max-w-md text-base leading-8 opacity-90">
                            Portal informasi Perpustakaan Desa Sobokerto yang
                            menghadirkan literasi, kearifan lokal, informasi
                            wisata, dan UMKM desa dalam satu portal yang mudah
                            diakses oleh masyarakat.
                        </p>
                    </div>

                    {/* Kontak */}
                    <div>
                        <h3 className="font-display text-xl font-semibold">
                            Kontak Perpustakaan
                        </h3>

                        <div className="mt-6 space-y-5 rounded-2xl bg-primary-foreground/10 p-6">

                            <div className="flex items-start gap-4">
                                <MapPin className="mt-1 h-5 w-5 shrink-0" />
                                <div>
                                    <p className="font-medium">Alamat</p>
                                    <p className="opacity-90">
                                        Desa Sobokerto, Kecamatan Ngemplak,
                                        Kabupaten Boyolali, Jawa Tengah
                                    </p>
                                </div>
                            </div>

                            <div className="flex items-center gap-4">
                                <Phone className="h-5 w-5 shrink-0" />
                                <div>
                                    <p className="font-medium">Telepon</p>
                                    <p className="opacity-90">
                                        (0276) 000-0000
                                    </p>
                                </div>
                            </div>

                            <div className="flex items-center gap-4">
                                <Mail className="h-5 w-5 shrink-0" />
                                <div>
                                    <p className="font-medium">Email</p>
                                    <p className="opacity-90">
                                        perpus.sobokerto@desa.id
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div className="mt-12 border-t border-primary-foreground/15 pt-6 text-center text-sm opacity-80">
                    © {new Date().getFullYear()} KALOKA — Perpustakaan Desa Sobokerto.
                </div>

            </div>
        </footer>
    );
}