import { Link } from 'react-router-dom';
import { ArrowRight, MapPin } from 'lucide-react';

const WARNA_KATEGORI = {
    Destinasi: 'bg-primary-soft text-primary',
    Kuliner:
        'bg-[oklch(0.94_0.07_30)] text-[oklch(0.4_0.15_25)]',
    Kerajinan:
        'bg-[oklch(0.94_0.07_75)] text-[oklch(0.38_0.12_60)]',
    Event:
        'bg-[oklch(0.92_0.05_220)] text-[oklch(0.30_0.10_220)]',
};

function warnaKategori(kategori) {
    return (
        WARNA_KATEGORI[kategori] ??
        WARNA_KATEGORI.Destinasi
    );
}

export default function WisataCard({ item }) {
    const detailUrl = `/wisata/${item.slug}`;

    return (
        <article className="card-soft group flex h-full flex-col overflow-hidden text-left">
            <Link
                to={detailUrl}
                className="block aspect-[4/3] w-full overflow-hidden bg-muted"
            >
                <img
                    src={item.foto_utama}
                    alt={item.nama_spot}
                    loading="lazy"
                    className="size-full object-cover transition duration-500 group-hover:scale-105"
                />
            </Link>

            <div className="flex flex-1 flex-col gap-3 p-5">
                <span
                    className={`inline-flex w-fit rounded-full px-3 py-1 text-xs font-semibold ${warnaKategori(
                        item.kategori,
                    )}`}
                >
                    {item.kategori}
                </span>

                <Link to={detailUrl}>
                    <h2 className="font-display text-xl leading-tight text-foreground transition hover:text-primary">
                        {item.nama_spot}
                    </h2>
                </Link>

                <p className="flex items-start gap-1.5 text-sm text-muted-foreground">
                    <MapPin className="mt-0.5 size-4 shrink-0" />
                    <span>{item.lokasi}</span>
                </p>

                <p className="line-clamp-2 flex-1 text-base leading-relaxed text-muted-foreground">
                    {item.deskripsi}
                </p>

                <Link
                    to={detailUrl}
                    className="mt-auto inline-flex w-fit items-center gap-2 pt-2 font-semibold text-primary transition-all group-hover:gap-3"
                >
                    Baca selengkapnya
                    <ArrowRight className="size-5" />
                </Link>
            </div>
        </article>
    );
}