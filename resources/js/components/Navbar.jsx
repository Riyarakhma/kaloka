import { NavLink, Link, useLocation } from 'react-router-dom';
import {
    ArrowLeft,
    Leaf,
    LogIn,
    Menu,
    X,
} from 'lucide-react';
import { useEffect, useState } from 'react';

const navItems = [
    { to: '/kearifan-lokal', label: 'Kearifan Lokal' },
    { to: '/wisata', label: 'Info Wisata' },
    { to: '/umkm', label: 'Galeri UMKM' },
];

const SLIMS_URL = 'https://desa.perpus.id';

export default function Navbar() {
    const [open, setOpen] = useState(false);
    const location = useLocation();

    const isHome = location.pathname === '/';

    useEffect(() => {
        setOpen(false);
    }, [location.pathname]);

    useEffect(() => {
        const handleEscape = (event) => {
            if (event.key === 'Escape') {
                setOpen(false);
            }
        };

        document.addEventListener('keydown', handleEscape);

        return () => {
            document.removeEventListener('keydown', handleEscape);
        };
    }, []);

    const menuLinkClass = ({ isActive }) =>
        `block rounded-2xl px-5 py-4 text-base font-semibold transition ${
            isActive
                ? 'bg-primary-soft text-primary'
                : 'text-foreground hover:bg-primary-soft hover:text-primary'
        }`;

    return (
        <header className="sticky top-0 z-50 border-b border-border bg-background/95 backdrop-blur">
            <div className="container-page flex min-h-[88px] items-center justify-between gap-6">
                {/* Bagian kiri: ikon kembali dan logo KALOKA */}
                <div className="flex min-w-0 items-center gap-3">
                    {!isHome && (
                        <Link
                            to="/"
                            onClick={() => setOpen(false)}
                            className="grid size-10 shrink-0 place-items-center text-primary transition hover:opacity-60"
                            aria-label="Kembali ke Beranda"
                            title="Kembali ke Beranda"
                        >
                            <ArrowLeft
                                className="size-5"
                                strokeWidth={2.2}
                            />
                        </Link>
                    )}

                    <Link
                        to="/"
                        className="flex min-w-0 items-center gap-3"
                        onClick={() => setOpen(false)}
                    >
                        <div className="grid size-12 shrink-0 place-items-center rounded-2xl bg-primary text-primary-foreground shadow-sm">
                            <Leaf
                                className="size-6"
                                strokeWidth={2.2}
                            />
                        </div>

                        <div className="min-w-0 leading-tight">
                            <div className="font-display text-xl font-bold text-primary">
                                KALOKA
                            </div>

                            <div className="hidden truncate text-xs text-muted-foreground sm:block">
                                Portal Literasi Desa Sobokerto
                            </div>
                        </div>
                    </Link>
                </div>

                {/* Tombol hamburger */}
                <button
                    type="button"
                    onClick={() => setOpen((value) => !value)}
                    className={`grid size-11 shrink-0 place-items-center rounded-xl border text-primary transition ${
                        open
                            ? 'border-primary bg-primary-soft'
                            : 'border-border bg-background hover:border-primary hover:bg-primary-soft'
                    }`}
                    aria-label={open ? 'Tutup menu' : 'Buka menu'}
                    aria-expanded={open}
                    aria-controls="menu-utama"
                >
                    {open ? (
                        <X
                            className="size-6"
                            strokeWidth={2}
                        />
                    ) : (
                        <Menu
                            className="size-6"
                            strokeWidth={2}
                        />
                    )}
                </button>
            </div>

            {/* Dropdown menu */}
            {open && (
                <>
                    <button
                        type="button"
                        className="fixed inset-0 top-[89px] z-40 cursor-default bg-black/10"
                        onClick={() => setOpen(false)}
                        aria-label="Tutup menu"
                    />

                    <div
                        id="menu-utama"
                        className="absolute right-6 top-[calc(100%+12px)] z-50 w-[360px] max-w-[calc(100vw-3rem)] overflow-hidden rounded-3xl border border-border bg-background shadow-2xl"
                    >
                        <nav className="flex flex-col gap-1 p-5">
                            <a
                                href={SLIMS_URL}
                                target="_blank"
                                rel="noopener noreferrer"
                                onClick={() => setOpen(false)}
                                className="block rounded-2xl px-5 py-4 text-base font-semibold text-foreground transition hover:bg-primary-soft hover:text-primary"
                            >
                                Katalog Pustaka
                            </a>

                            {navItems.map(({ to, label }) => (
                                <NavLink
                                    key={to}
                                    to={to}
                                    className={menuLinkClass}
                                    onClick={() => setOpen(false)}
                                >
                                    {label}
                                </NavLink>
                            ))}

                            <div className="my-3 border-t border-border" />

                            <a
                                href="/login"
                                onClick={() => setOpen(false)}
                                className="flex items-center justify-center gap-2 rounded-2xl bg-primary px-5 py-4 text-base font-semibold text-primary-foreground transition hover:opacity-90"
                            >
                                <LogIn className="size-5" />
                                Masuk sebagai Pengelola
                            </a>
                        </nav>
                    </div>
                </>
            )}
        </header>
    );
}