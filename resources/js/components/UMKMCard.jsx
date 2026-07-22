import { Link } from 'react-router-dom';
import {
    ArrowRight,
    MapPin,
    Store,
} from 'lucide-react';

const WARNA_KATEGORI = {
    Kerajinan:
        'bg-purple-100 text-purple-700',
    Kuliner:
        'bg-orange-100 text-orange-700',
    Pertanian:
        'bg-green-100 text-green-700',
    Budidaya:
        'bg-blue-100 text-blue-700',
};

function warnaKategori(kategori) {
    return (
        WARNA_KATEGORI[kategori] ??
        'bg-primary-soft text-primary'
    );
}

export default function UMKMCard({ item }) {
    const detailUrl = `/umkm/${item.slug}`;

    return (
        <article className="card-soft group flex h-full flex-col overflow-hidden text-left">
            <Link
                to={detailUrl}
                className="block aspect-[4/3] w-full overflow-hidden bg-muted"
                aria-label={`Buka informasi ${item.nama_umkm}`}
            >
                {item.foto ? (
                    <img
                        src={item.foto}
                        alt={item.nama_umkm}
                        loading="lazy"
                        className="size-full object-cover transition duration-500 group-hover:scale-105"
                    />
                ) : (
                    <div className="flex size-full flex-col items-center justify-center gap-3 bg-primary-soft/50 text-muted-foreground">
                        <Store className="size-12 text-primary" />

                        <span className="text-sm">
                            Foto belum tersedia
                        </span>
                    </div>
                )}
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
                        {item.nama_umkm}
                    </h2>
                </Link>

                {item.alamat && (
                    <p className="flex items-start gap-1.5 text-sm text-muted-foreground">
                        <MapPin className="mt-0.5 size-4 shrink-0" />

                        <span>{item.alamat}</span>
                    </p>
                )}

                <p className="line-clamp-3 flex-1 text-base leading-relaxed text-muted-foreground">
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