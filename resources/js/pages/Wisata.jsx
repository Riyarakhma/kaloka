import { useMemo, useState } from 'react';
import {
    Mountain,
    Search,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import WisataCard from '../components/WisataCard';
import {
    useWisataItems,
    KATEGORI_WISATA,
} from '../lib/wisata-api';

function FilterChip({ active, onClick, label }) {
    return (
        <button
            type="button"
            onClick={onClick}
            className={`rounded-full border-2 px-5 py-2.5 text-base font-semibold transition ${
                active
                    ? 'border-primary bg-primary text-primary-foreground'
                    : 'border-border bg-card text-foreground hover:border-primary hover:text-primary'
            }`}
        >
            {label}
        </button>
    );
}

export default function Wisata() {
    const [filter, setFilter] = useState('semua');
    const [search, setSearch] = useState('');

    const {
        data: items = [],
        isLoading,
        isError,
    } = useWisataItems(filter);

    const itemsTersaring = useMemo(() => {
        const kata = search.trim().toLowerCase();

        if (!kata) {
            return items;
        }

        return items.filter((item) => {
            const teks = [
                item.nama,
                item.judul,
                item.deskripsi,
                item.lokasi,
                item.kategori,
            ]
                .filter(Boolean)
                .join(' ')
                .toLowerCase();

            return teks.includes(kata);
        });
    }, [items, search]);

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            {/* ===== HEADER HALAMAN ===== */}
            <section className="border-b border-border bg-primary-soft/60">
                <div className="container-page py-14 md:py-20">
                    <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                        <Mountain className="size-4" />
                        Pesona Desa
                    </span>

                    <h1 className="mt-4 font-display text-4xl md:text-5xl">
                        Info Wisata Sobokerto
                    </h1>

                    <p className="mt-3 max-w-2xl text-lg text-muted-foreground">
                        Jelajahi keindahan Waduk Cengklik, kuliner khas,
                        kerajinan warga, dan berbagai kegiatan menarik di Desa
                        Sobokerto.
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
                            placeholder="Cari wisata Sobokerto..."
                            className="w-full bg-transparent py-3 text-lg text-foreground placeholder:text-muted-foreground focus:outline-none"
                        />
                    </form>
                </div>
            </section>

            {/* ===== FILTER DAN CARD ===== */}
            <section className="container-page mt-10">
                <div className="flex flex-wrap gap-2">
                    <FilterChip
                        active={filter === 'semua'}
                        onClick={() => setFilter('semua')}
                        label="Semua"
                    />

                    {KATEGORI_WISATA.map((kategori) => (
                        <FilterChip
                            key={kategori}
                            active={filter === kategori}
                            onClick={() => setFilter(kategori)}
                            label={kategori}
                        />
                    ))}
                </div>

                {isLoading ? (
                    <div className="mt-12 text-center text-muted-foreground">
                        Memuat data...
                    </div>
                ) : isError ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-destructive bg-card p-10 text-center">
                        <Mountain className="mx-auto mb-4 size-12 text-destructive" />

                        <h3 className="text-xl font-semibold text-destructive">
                            Gagal memuat data
                        </h3>

                        <p className="mt-2 text-muted-foreground">
                            Pastikan server API sedang berjalan.
                        </p>
                    </div>
                ) : itemsTersaring.length === 0 ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-border bg-card p-10 text-center">
                        <Mountain className="mx-auto mb-4 size-12 text-primary" />

                        <h3 className="text-xl font-semibold">
                            Wisata tidak ditemukan
                        </h3>

                        <p className="mt-2 text-muted-foreground">
                            Tidak ada spot wisata yang sesuai dengan pencarian
                            Anda.
                        </p>
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

            <Footer />
        </div>
    );
}