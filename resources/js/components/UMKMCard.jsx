import { Link } from 'react-router-dom';
import { ArrowRight } from 'lucide-react';

export default function UMKMCard({ item }) {
    return (
        <Link
            to={`/umkm/${item.slug}`}
            className="card-soft group flex h-full flex-col text-left"
            aria-label={item.nama}
        >
            <div className="aspect-[4/3] w-full overflow-hidden bg-muted">
                <img
                    src={item.foto}
                    alt={item.nama}
                    loading="lazy"
                    className="size-full object-cover transition duration-500 group-hover:scale-105"
                />
            </div>

            <div className="flex flex-1 flex-col gap-3 p-5">
                <span className="inline-flex w-fit rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-primary">
                    {item.kategori}
                </span>

                <h3 className="font-display text-xl leading-tight text-foreground">
                    {item.nama}
                </h3>

                <p className="text-base leading-relaxed text-muted-foreground line-clamp-3">
                    {item.deskripsi}
                </p>

                <div className="mt-auto flex items-center gap-2 pt-2 text-base font-semibold text-primary">
                    Lihat produk
                    <ArrowRight className="size-5 transition group-hover:translate-x-1" />
                </div>
            </div>
        </Link>
    );
}