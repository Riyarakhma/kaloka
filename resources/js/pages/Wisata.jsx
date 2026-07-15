import { useMemo, useState } from 'react';
import { Mountain, Search } from 'lucide-react';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import WisataCard from '../components/WisataCard';
import { useWisataItems, KATEGORI_WISATA } from '../lib/wisata-api';

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
    const { data: items = [], isLoading, isError } = useWisataItems(filter);

    const itemsTersaring = useMemo(() => {
        const kata = search.trim().toLowerCase();

        if (!kata) return items;

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

            <section className="border-b border-border bg-primary-soft/60">
                <div className="container-page py-14 md:py-20">
                    <span className="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-sm font-semibold text-primary">
                        <Mountain className="size-4" />
                        Pesona desa
                    </span>
                    <h1 className="mt-4 font-display text-4xl md:text-5xl">Info Wisata Sobokerto</h1>
                    <p className="mt-3 max-w-2xl text-lg text-muted-foreground">
                        Jelajahi keindahan Waduk Cengklik, kuliner khas, kerajinan warga,
                        dan berbagai kegiatan menarik di Desa Sobokerto.
                    </p>
                </div>
            </section>

            <section className="container-page mt-10">
                <div className="max-w-xl">
                    <label htmlFor="pencarian-wisata" className="mb-2 block text-sm font-semibold text-foreground">
                        Cari wisata
                    </label>
                    <div className="relative">
                        <Search className="pointer-events-none absolute left-4 top-1/2 size-5 -translate-y-1/2 text-muted-foreground" />
                        <input
                            id="pencarian-wisata"
                            type="text"
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                            placeholder="Cari nama, lokasi, atau deskripsi..."
                            className="w-full rounded-2xl border border-border bg-card py-3 pl-12 pr-4 text-foreground outline-none transition focus:border-primary"
                        />
                    </div>
                </div>

                <div className="mt-6 flex flex-wrap gap-2">
                    <FilterChip
                        active={filter === 'semua'}
                        onClick={() => setFilter('semua')}
                        label="Semua"
                    />
                    {KATEGORI_WISATA.map((k) => (
                        <FilterChip
                            key={k}
                            active={filter === k}
                            onClick={() => setFilter(k)}
                            label={k}
                        />
                    ))}
                </div>

                {isLoading ? (
                    <div className="mt-12 text-center text-muted-foreground">Memuat data…</div>
                ) : isError ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-destructive bg-card p-10 text-center">
                        <p className="text-lg text-destructive">
                            Gagal memuat data. Pastikan server API sedang berjalan.
                        </p>
                    </div>
                ) : itemsTersaring.length === 0 ? (
                    <div className="mt-12 rounded-2xl border border-dashed border-border bg-card p-10 text-center">
                        <p className="text-lg text-muted-foreground">
                            Tidak ada spot wisata yang sesuai dengan pencarian ini.
                        </p>
                    </div>
                ) : (
                    <div className="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        {itemsTersaring.map((item) => (
                            <WisataCard key={item.id} item={item} />
                        ))}
                    </div>
                )}
            </section>

            <Footer />
        </div>
    );
}