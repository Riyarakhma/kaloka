import { Leaf, MapPin, Phone, Mail } from 'lucide-react';
import { usePengaturan } from '../lib/pengaturan-api';

export default function Footer() {
    const { data: pengaturan } = usePengaturan();

    const alamat =
        pengaturan?.footer_alamat ||
        'Desa Sobokerto, Kecamatan Ngemplak, Kabupaten Boyolali, Jawa Tengah';
    const telepon = pengaturan?.footer_telepon || '(0276) 000-0000';
    const email = pengaturan?.footer_email || 'perpus.sobokerto@desa.id';
    const instagram = pengaturan?.footer_instagram || '@desa_sobokerto';

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

                    {/* Hubungi Kami */}
                    <div>
                        <h3 className="font-display text-xl font-semibold">
                            Hubungi Kami
                        </h3>

                        <div className="mt-6 space-y-5 rounded-2xl bg-primary-foreground/10 p-6">

                            <div className="flex items-start gap-4">
                                <MapPin className="mt-1 h-5 w-5 shrink-0" />
                                <div>
                                    <p className="font-medium">Alamat</p>
                                    <p className="opacity-90">
                                        {alamat}
                                    </p>
                                </div>
                            </div>

                            <div className="flex items-center gap-4">
                                <Phone className="h-5 w-5 shrink-0" />
                                <div>
                                    <p className="font-medium">Telepon</p>
                                    <p className="opacity-90">
                                        {telepon}
                                    </p>
                                </div>
                            </div>

                            <div className="flex items-center gap-4">
                                <Mail className="h-5 w-5 shrink-0" />
                                <div>
                                    <p className="font-medium">Email</p>
                                    <p className="opacity-90">
                                        {email}
                                    </p>
                                </div>
                            </div>

                            <div className="flex items-center gap-4">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="2"
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    className="h-5 w-5 shrink-0"
                                >
                                    <rect
                                        x="2"
                                        y="2"
                                        width="20"
                                        height="20"
                                        rx="5"
                                        ry="5"
                                    />
                                    <path d="M16 11.37a4 4 0 1 1-1.37-1.37A4 4 0 0 1 16 11.37z" />
                                    <line
                                        x1="17.5"
                                        y1="6.5"
                                        x2="17.51"
                                        y2="6.5"
                                    />
                                </svg>

                                <div>
                                    <p className="font-medium">Instagram</p>
                                    <p className="opacity-90">
                                        {instagram}
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