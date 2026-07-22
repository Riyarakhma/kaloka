import { useMemo, useState } from 'react';
import {
    Check,
    ChevronDown,
    Mountain,
    Search,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import WisataCard from '../components/WisataCard';

import {
    WISATA_ITEMS,
    KATEGORI_WISATA,
} from '../data/wisataData';

export default function Wisata() {
    const [filter, setFilter] = useState('semua');
    const [search, setSearch] = useState('');
    const [categoryOpen, setCategoryOpen] = useState(false);

    const categoryOptions = useMemo(
        () => [
            {
                id: 'semua',
                label: 'Semua Kategori',
            },
            ...KATEGORI_WISATA,
        ],
        [],
    );

    const selectedCategory =
        categoryOptions.find(
            (kategori) => kategori.id === filter,
        ) ?? categoryOptions[0];

    const itemsTersaring = useMemo(() => {
        const kata = search.trim().toLowerCase();

        return WISATA_ITEMS.filter((item) => {
            const sesuaiKategori =
                filter === 'semua' || item.kategori === filter;

            if (!sesuaiKategori) {
                return false;
            }

            if (!kata) {
                return true;
            }

            const teks = [
                item.nama_spot,
                item.kategori,
                item.deskripsi,
                item.lokasi,
                item.jam_operasional,
            ]
                .filter(Boolean)
                .join(' ')
                .toLowerCase();

            return teks.includes(kata);
        });
    }, [filter, search]);

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <main>
                <section className="border-b border-border bg-primary-soft/60">
                    <div className="container-page py-14 md:py-20">
                        <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                            <Mountain className="size-4" />
                            Pesona Desa
                        </span>

                        <h1 className="mt-4 font-display text-4xl text-foreground md:text-5xl">
                            Info Wisata Sobokerto
                        </h1>

                        <p className="mt-3 max-w-2xl text-lg leading-8 text-muted-foreground">
                            Jelajahi keindahan Waduk Cengklik, kuliner khas,
                            kerajinan warga, dan berbagai kegiatan menarik di
                            Desa Sobokerto.
                        </p>

                        <form
                            className="mt-8 flex items-center gap-3 rounded-2xl border border-border bg-background p-2 shadow-sm"
                            onSubmit={(event) => event.preventDefault()}
                            role="search"
                        >
                            <Search className="ml-3 size-6 shrink-0 text-primary" />

                            <label
                                htmlFor="pencarian-wisata"
                                className="sr-only"
                            >
                                Cari wisata
                            </label>

                            <input
                                id="pencarian-wisata"
                                type="search"
                                value={search}
                                onChange={(event) =>
                                    setSearch(event.target.value)
                                }
                                placeholder="Cari destinasi, kuliner, kerajinan, atau event..."
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
                                                        setCategoryOpen(false);
                                                    }}
                                                    className={`flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm transition ${
                                                        isActive
                                                            ? 'bg-primary-soft font-medium text-primary'
                                                            : 'text-foreground hover:bg-primary-soft/60'
                                                    }`}
                                                >
                                                    <span>
                                                        {kategori.label}
                                                    </span>

                                                    {isActive && (
                                                        <Check className="size-4 text-primary" />
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
                                {itemsTersaring.length}
                            </span>{' '}
                            tempat wisata
                        </p>
                    </div>

                    {itemsTersaring.length === 0 ? (
                        <div className="mt-12 rounded-3xl border border-dashed border-border bg-card p-10 text-center">
                            <Mountain className="mx-auto mb-4 size-12 text-primary" />

                            <h2 className="text-xl font-semibold text-foreground">
                                Wisata tidak ditemukan
                            </h2>

                            <p className="mt-2 text-muted-foreground">
                                Tidak ada tempat wisata yang sesuai dengan
                                pencarian atau kategori yang dipilih.
                            </p>

                            <button
                                type="button"
                                onClick={() => {
                                    setSearch('');
                                    setFilter('semua');
                                }}
                                className="mt-6 rounded-xl bg-primary px-5 py-3 font-semibold text-white"
                            >
                                Tampilkan semua
                            </button>
                        </div>
                    ) : (
                        <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {itemsTersaring.map((item) => (
                                <WisataCard
                                    key={item.id}
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