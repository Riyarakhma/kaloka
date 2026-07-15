import { ArrowRight, MapPin } from 'lucide-react';
import { warnaKategoriWisata } from '../lib/wisata-api';

export default function WisataCard({ item }) {
    return (
        <div className="card-soft group flex h-full flex-col text-left overflow-hidden">
            <div className="aspect-[4/3] w-full overflow-hidden bg-muted">
                {item.foto_utama ? (
                    <img
                        src={item.foto_utama}
                        alt={item.nama_spot}
                        loading="lazy"
                        className="size-full object-cover transition duration-500 group-hover:scale-105"
                    />
                ) : (
                    <div className="flex size-full items-center justify-center text-muted-foreground">
                        <MapPin className="size-10" />
                    </div>
                )}
            </div>
            <div className="flex flex-1 flex-col gap-3 p-5">
                <span
                    className={`inline-flex w-fit items-center rounded-full px-3 py-1 text-xs font-semibold ${warnaKategoriWisata(item.kategori)}`}
                >
                    {item.kategori}
                </span>
                <h3 className="font-display text-xl leading-tight text-foreground">
                    {item.nama_spot}
                </h3>
                {item.lokasi && (
                    <p className="flex items-center gap-1.5 text-sm text-muted-foreground">
                        <MapPin className="size-4 shrink-0" />
                        {item.lokasi}
                    </p>
                )}
                <p className="text-base leading-relaxed text-muted-foreground line-clamp-2">
                    {item.deskripsi}
                </p>
                <div className="mt-auto flex items-center gap-2 pt-2 text-base font-semibold text-primary">
                    Lihat detail
                    <ArrowRight className="size-5 transition group-hover:translate-x-1" />
                </div>
            </div>
        </div>
    );
}