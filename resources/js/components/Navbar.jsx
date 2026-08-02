import {
    ArrowUpRight,
    Leaf,
    LogIn,
} from 'lucide-react';
import { usePengaturan } from '../lib/pengaturan-api';

const SLIMS_URL = 'https://desa.perpus.id';

export default function Navbar() {
    const { data: pengaturan } = usePengaturan();

    return (
        <header className="relative z-50 border-b border-border/70 bg-background/95 backdrop-blur-md">
            <div className="container-page flex min-h-[86px] items-center justify-between gap-4 py-3">

                {/* Logo (Tidak bisa diklik) */}
                <div className="flex min-w-0 select-none items-center gap-3 sm:gap-4">
                    {pengaturan?.logo ? (
                        <img
                            src={pengaturan.logo}
                            alt="Logo"
                            className="size-12 shrink-0 rounded-2xl object-cover shadow-sm sm:size-14"
                        />
                    ) : (
                        <div className="grid size-12 shrink-0 place-items-center rounded-2xl bg-primary text-primary-foreground shadow-sm sm:size-14">
                            <Leaf
                                className="size-6 sm:size-7"
                                strokeWidth={2}
                            />
                        </div>
                    )}

                    <div className="min-w-0">
                        <p className="font-display truncate text-xl font-extrabold tracking-[-0.03em] text-primary sm:text-2xl">
                            KALOKA
                        </p>

                        <p className="mt-0.5 hidden truncate text-xs font-medium text-muted-foreground sm:block sm:text-sm">
                            Portal Literasi Desa Sobokerto
                        </p>
                    </div>
                </div>

                {/* Tombol kanan */}
                <div className="flex shrink-0 items-center gap-3">

                    {/* Katalog Pustaka */}
                    <a
                        href={SLIMS_URL}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="group inline-flex items-center gap-2 rounded-full border border-primary/25 bg-background px-5 py-2.5 text-sm font-semibold text-primary transition duration-300 hover:border-primary hover:bg-primary hover:text-primary-foreground focus:outline-none focus:ring-4 focus:ring-primary/15"
                    >
                        <span className="hidden sm:inline">
                            Katalog Pustaka
                        </span>

                        <span className="sm:hidden">
                            Katalog
                        </span>

                        <ArrowUpRight className="size-4 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                    </a>

                    {/* Login */}
                    <a
                        href="/login"
                        className="group inline-flex items-center gap-2 rounded-full border border-primary/25 bg-background px-5 py-2.5 text-sm font-semibold text-primary transition duration-300 hover:border-primary hover:bg-primary hover:text-primary-foreground focus:outline-none focus:ring-4 focus:ring-primary/15"
                    >
                        <span>
                            Login
                        </span>

                        <LogIn className="size-4 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                    </a>

                </div>
            </div>
        </header>
    );
}