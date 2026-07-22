import { useMemo, useState } from 'react';
import { Link } from 'react-router-dom';
import {
    ArrowRight,
    Check,
    ChevronDown,
    Leaf,
    Search,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';

import {
    KEARIFAN_ITEMS,
    KATEGORI_KEARIFAN,
} from '../data/kearifanData';

function KearifanCard({ item }) {
    const kategoriLabel =
        KATEGORI_KEARIFAN.find(
            (kategori) => kategori.id === item.kategori,
        )?.label ?? item.kategori;

    const detailUrl = `/kearifan-lokal/${item.slug}`;

    return (
        <article className="group flex h-full flex-col overflow-hidden rounded-3xl border border-border bg-card shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
            <Link
                to={detailUrl}
                className="block aspect-[3/2] overflow-hidden bg-muted"
                aria-label={`Buka artikel ${item.judul}`}
            >
                <img
                    src={item.foto}
                    alt={item.judul}
                    className="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    loading="lazy"
                />
            </Link>

            <div className="flex flex-1 flex-col p-6">
                <span className="w-fit rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-primary">
                    {kategoriLabel}
                </span>

                <Link
                    to={detailUrl}
                    className="mt-4 block"
                >
                    <h2 className="font-display text-2xl leading-tight text-foreground transition-colors hover:text-primary">
                        {item.judul}
                    </h2>
                </Link>

                <p className="mt-3 flex-1 text-base leading-7 text-muted-foreground">
                    {item.deskripsi}
                </p>

                <Link
                    to={detailUrl}
                    className="mt-6 inline-flex w-fit items-center gap-2 font-semibold text-primary transition-all duration-200 group-hover:gap-3"
                >
                    Baca selengkapnya
                    <ArrowRight className="size-5" />
                </Link>
            </div>
        </article>
    );
}

export default function KearifanLokal() {
    const [filter, setFilter] = useState('semua');
    const [query, setQuery] = useState('');
    const [categoryOpen, setCategoryOpen] = useState(false);

    const categoryOptions = useMemo(
        () => [
            {
                id: 'semua',
                label: 'Semua Kategori',
            },
            ...KATEGORI_KEARIFAN,
        ],
        [],
    );

    const selectedCategory =
        categoryOptions.find(
            (kategori) => kategori.id === filter,
        ) ?? categoryOptions[0];

    const filteredItems = useMemo(() => {
        const normalizedQuery = query.trim().toLowerCase();

        return KEARIFAN_ITEMS.filter((item) => {
            const sesuaiKategori =
                filter === 'semua' || item.kategori === filter;

            if (!sesuaiKategori) {
                return false;
            }

            if (!normalizedQuery) {
                return true;
            }

            const kategoriLabel =
                KATEGORI_KEARIFAN.find(
                    (kategori) => kategori.id === item.kategori,
                )?.label ?? '';

            const kataKunci = Array.isArray(item.kataKunci)
                ? item.kataKunci.join(' ')
                : '';

            const narasumber =
                typeof item.narasumber === 'object'
                    ? [
                          item.narasumber?.nama,
                          item.narasumber?.keterangan,
                          item.narasumber?.asal,
                      ]
                          .filter(Boolean)
                          .join(' ')
                    : item.narasumber ?? '';

            const searchableContent = [
                item.judul,
                item.deskripsi,
                kategoriLabel,
                kataKunci,
                narasumber,
                item.lokasi,
                item.bahasa,
                item.jenisMedia,
                item.pendokumentasi,
                item.sumber,
            ]
                .filter(Boolean)
                .join(' ')
                .toLowerCase();

            return searchableContent.includes(normalizedQuery);
        });
    }, [filter, query]);

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <main>
                <section className="border-b border-border bg-primary-soft/60">
                    <div className="container-page py-14 md:py-20">
                        <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                            <Leaf className="size-4" />
                            Warisan Warga Desa
                        </span>

                        <h1 className="mt-4 font-display text-4xl text-foreground md:text-5xl">
                            Kearifan Lokal Sobokerto
                        </h1>

                        <p className="mt-3 max-w-2xl text-lg leading-8 text-muted-foreground">
                            Jelajahi pengetahuan lokal, kehidupan masyarakat,
                            pertanian, sejarah, serta potensi lingkungan Desa
                            Sobokerto.
                        </p>

                        <form
                            className="mt-8 flex items-center gap-3 rounded-2xl border border-border bg-background p-2 shadow-sm"
                            onSubmit={(event) => event.preventDefault()}
                            role="search"
                        >
                            <Search className="ml-3 size-6 shrink-0 text-primary" />

                            <label
                                htmlFor="pencarian-kearifan"
                                className="sr-only"
                            >
                                Cari kearifan lokal
                            </label>

                            <input
                                id="pencarian-kearifan"
                                type="search"
                                value={query}
                                onChange={(event) =>
                                    setQuery(event.target.value)
                                }
                                placeholder="Cari judul, kategori, kata kunci, atau narasumber..."
                                className="w-full bg-transparent py-3 text-lg text-foreground placeholder:text-muted-foreground focus:outline-none"
                            />
                        </form>
                    </div>
                </section>

                <section className="container-page py-10 md:py-14">
                    <div className="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                        <div className="relative w-full max-w-md">
                            <button
                                type="button"
                                onClick={() =>
                                    setCategoryOpen(
                                        (previousValue) => !previousValue,
                                    )
                                }
                                className={`flex w-full items-center justify-between gap-4 rounded-xl border bg-background px-4 py-3 text-left transition ${
                                    categoryOpen
                                        ? 'border-primary ring-2 ring-primary/10'
                                        : 'border-border hover:border-primary'
                                }`}
                                aria-haspopup="listbox"
                                aria-expanded={categoryOpen}
                            >
                                <span className="truncate text-base font-medium text-foreground">
                                    {selectedCategory.label}
                                </span>

                                <ChevronDown
                                    className={`size-5 shrink-0 text-muted-foreground transition-transform duration-200 ${
                                        categoryOpen ? 'rotate-180' : ''
                                    }`}
                                />
                            </button>

                            {categoryOpen && (
                                <>
                                    <button
                                        type="button"
                                        onClick={() =>
                                            setCategoryOpen(false)
                                        }
                                        className="fixed inset-0 z-30 cursor-default"
                                        aria-label="Tutup pilihan kategori"
                                    />

                                    <div
                                        className="absolute left-0 top-full z-40 mt-2 w-full overflow-hidden rounded-xl border border-border bg-background p-1 shadow-lg"
                                        role="listbox"
                                        aria-label="Pilihan kategori kearifan lokal"
                                    >
                                        {categoryOptions.map((kategori) => {
                                            const isActive =
                                                kategori.id === filter;

                                            return (
                                                <button
                                                    key={kategori.id}
                                                    type="button"
                                                    onClick={() => {
                                                        setFilter(
                                                            kategori.id,
                                                        );
                                                        setCategoryOpen(
                                                            false,
                                                        );
                                                    }}
                                                    className={`flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm transition ${
                                                        isActive
                                                            ? 'bg-primary-soft font-medium text-primary'
                                                            : 'text-foreground hover:bg-primary-soft/60'
                                                    }`}
                                                    role="option"
                                                    aria-selected={isActive}
                                                >
                                                    <span className="truncate">
                                                        {kategori.label}
                                                    </span>

                                                    {isActive && (
                                                        <Check className="size-4 shrink-0 text-primary" />
                                                    )}
                                                </button>
                                            );
                                        })}
                                    </div>
                                </>
                            )}
                        </div>

                        <p className="text-sm text-muted-foreground">
                            Menampilkan{' '}
                            <span className="font-semibold text-foreground">
                                {filteredItems.length}
                            </span>{' '}
                            dokumentasi
                        </p>
                    </div>

                    {filteredItems.length === 0 ? (
                        <div className="mt-12 rounded-3xl border border-dashed border-border bg-card p-10 text-center">
                            <Leaf className="mx-auto mb-4 size-12 text-primary" />

                            <h2 className="text-xl font-semibold text-foreground">
                                Kearifan lokal tidak ditemukan
                            </h2>

                            <p className="mt-2 text-muted-foreground">
                                Tidak ada konten yang sesuai dengan pencarian
                                atau kategori yang dipilih.
                            </p>

                            <button
                                type="button"
                                onClick={() => {
                                    setQuery('');
                                    setFilter('semua');
                                }}
                                className="mt-6 rounded-xl bg-primary px-5 py-3 font-semibold text-white transition hover:opacity-90"
                            >
                                Tampilkan semua
                            </button>
                        </div>
                    ) : (
                        <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {filteredItems.map((item) => (
                                <KearifanCard
                                    key={item.slug}
                                    item={item}
                                />
                            ))}
                        </div>
                    )}
                </section>
            </main>

            <Footer />
        </div>
    );
}