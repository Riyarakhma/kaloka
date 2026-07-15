import { NavLink, Link } from 'react-router-dom';
import { Menu, X, BookOpen, Leaf, Mountain, LogIn, ExternalLink } from 'lucide-react';
import { useState } from 'react';

const navItems = [
    { to: '/kearifan-lokal', label: 'Kearifan Lokal', icon: Leaf },
    { to: '/wisata', label: 'Info Wisata', icon: Mountain },
];

const SLIMS_URL = 'https://desa.perpus.id';

export default function Navbar() {
    const [open, setOpen] = useState(false);

    const linkClass = ({ isActive }) =>
        `inline-flex items-center gap-2 rounded-full px-4 py-2 text-base font-semibold text-foreground transition hover:bg-primary-soft ${
            isActive ? 'bg-primary-soft text-primary' : ''
        }`;

    return (
        <header className="sticky top-0 z-50 border-b border-border bg-background/90 backdrop-blur">
            <div className="container-page flex items-center justify-between gap-4 py-4">
                <Link to="/" className="flex items-center gap-3">
                    <div className="grid size-11 shrink-0 place-items-center rounded-2xl bg-primary text-primary-foreground shadow-sm">
                        <Leaf className="size-6" strokeWidth={2.2} />
                    </div>
                    <div className="min-w-0 leading-tight">
                        <div className="font-display text-xl font-bold text-primary">KALOKA</div>
                        <div className="truncate text-xs text-muted-foreground">
                            Portal Literasi Desa Sobokerto
                        </div>
                    </div>
                </Link>

                <nav className="hidden items-center gap-2 md:flex">
                    <a
                        href={SLIMS_URL}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="inline-flex items-center gap-2 rounded-full px-4 py-2 text-base font-semibold text-foreground transition hover:bg-primary-soft"
                    >
                        <BookOpen className="size-5" />
                        Katalog Pustaka
                        <ExternalLink className="size-4 opacity-60" />
                    </a>
                    {navItems.map((item) => (
                        <NavLink key={item.to} to={item.to} className={linkClass}>
                            <item.icon className="size-5" />
                            {item.label}
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

                <button
                    type="button"
                    onClick={() => setOpen((v) => !v)}
                    className="grid size-12 shrink-0 place-items-center rounded-xl border border-border bg-card text-primary md:hidden"
                    aria-label="Buka menu"
                    aria-expanded={open}
                >
                    {open ? <X className="size-6" /> : <Menu className="size-6" />}
                </button>
            </div>

            {open && (
                <nav className="border-t border-border bg-card md:hidden">
                    <div className="container-page flex flex-col gap-1 py-3">
                        <a
                            href={SLIMS_URL}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="flex items-center gap-3 rounded-xl px-4 py-4 text-lg font-semibold text-foreground hover:bg-primary-soft"
                            onClick={() => setOpen(false)}
                        >
                            <BookOpen className="size-6 text-primary" />
                            Katalog Pustaka
                            <ExternalLink className="ml-auto size-4 opacity-60" />
                        </a>
                        {navItems.map((item) => (
                            <NavLink
                                key={item.to}
                                to={item.to}
                                onClick={() => setOpen(false)}
                                className={linkClass}
                            >
                                <item.icon className="size-6 text-primary" />
                                {item.label}
                            </NavLink>
                        ))}
                        <a
                            href="/login"
                            onClick={() => setOpen(false)}
                            className="mt-2 flex items-center justify-center gap-2 rounded-full border-2 border-primary px-4 py-3 text-lg font-semibold text-primary"
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