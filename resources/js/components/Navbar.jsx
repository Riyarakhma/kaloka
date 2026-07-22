import { NavLink, Link } from 'react-router-dom';
import {
    Leaf,
    LogIn,
    Menu,
    X,
} from 'lucide-react';
import { useState } from 'react';

const navItems = [
    { to: '/kearifan-lokal', label: 'Kearifan Lokal' },
    { to: '/wisata', label: 'Info Wisata' },
    { to: '/umkm', label: 'Galeri UMKM' },
];

const SLIMS_URL = 'https://desa.perpus.id';

export default function Navbar() {
    const [open, setOpen] = useState(false);

    const linkClass = ({ isActive }) =>
        `rounded-full px-4 py-2 text-base font-semibold transition ${
            isActive
                ? 'bg-primary-soft text-primary'
                : 'text-foreground hover:bg-primary-soft hover:text-primary'
        }`;

    const mobileLinkClass = ({ isActive }) =>
        `rounded-xl px-4 py-4 text-lg font-semibold transition ${
            isActive
                ? 'bg-primary-soft text-primary'
                : 'text-foreground hover:bg-primary-soft'
        }`;

    return (
        <header className="sticky top-0 z-50 border-b border-border bg-background/90 backdrop-blur">
            <div className="container-page flex items-center justify-between gap-4 py-4">
                {/* Logo */}
                <Link
                    to="/"
                    className="flex items-center gap-3"
                    onClick={() => setOpen(false)}
                >
                    <div className="grid size-11 shrink-0 place-items-center rounded-2xl bg-primary text-primary-foreground shadow-sm">
                        <Leaf
                            className="size-6"
                            strokeWidth={2.2}
                        />
                    </div>

                    <div className="min-w-0 leading-tight">
                        <div className="font-display text-xl font-bold text-primary">
                            KALOKA
                        </div>

                        <div className="truncate text-xs text-muted-foreground">
                            Portal Literasi Desa Sobokerto
                        </div>
                    </div>
                </Link>

                {/* Menu desktop */}
                <nav className="hidden items-center gap-2 md:flex">
                    <a
                        href={SLIMS_URL}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="rounded-full px-4 py-2 text-base font-semibold text-foreground transition hover:bg-primary-soft hover:text-primary"
                    >
                        Katalog Pustaka
                    </a>

                    {navItems.map(({ to, label }) => (
                        <NavLink
                            key={to}
                            to={to}
                            className={linkClass}
                        >
                            {label}
                        </NavLink>
                    ))}

                    <a
                        href="/login"
                        className="ml-2 inline-flex items-center gap-2 rounded-full border-2 border-primary px-4 py-2 text-base font-semibold text-primary transition hover:bg-primary hover:text-primary-foreground"
                    >
                        <LogIn className="size-5" />
                        Masuk
                    </a>
                </nav>

                {/* Tombol mobile */}
                <button
                    type="button"
                    onClick={() => setOpen((value) => !value)}
                    className="grid size-12 shrink-0 place-items-center rounded-xl border border-border bg-card text-primary md:hidden"
                    aria-label={open ? 'Tutup menu' : 'Buka menu'}
                    aria-expanded={open}
                >
                    {open ? (
                        <X className="size-6" />
                    ) : (
                        <Menu className="size-6" />
                    )}
                </button>
            </div>

            {/* Menu mobile */}
            {open && (
                <nav className="border-t border-border bg-card md:hidden">
                    <div className="container-page flex flex-col gap-1 py-3">
                        <a
                            href={SLIMS_URL}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="rounded-xl px-4 py-4 text-lg font-semibold text-foreground transition hover:bg-primary-soft"
                            onClick={() => setOpen(false)}
                        >
                            Katalog Pustaka
                        </a>

                        {navItems.map(({ to, label }) => (
                            <NavLink
                                key={to}
                                to={to}
                                className={mobileLinkClass}
                                onClick={() => setOpen(false)}
                            >
                                {label}
                            </NavLink>
                        ))}

                        <a
                            href="/login"
                            onClick={() => setOpen(false)}
                            className="mt-2 flex items-center justify-center gap-2 rounded-full border-2 border-primary px-4 py-3 text-lg font-semibold text-primary transition hover:bg-primary hover:text-primary-foreground"
                        >
                            <LogIn className="size-5" />
                            Masuk sebagai Pengelola
                        </a>
                    </div>
                </nav>
            )}
        </header>
    );
}