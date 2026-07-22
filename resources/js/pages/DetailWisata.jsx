import { Link, Navigate, useParams } from 'react-router-dom';
import {
    ArrowLeft,
    Clock3,
    Eye,
    EyeOff,
    ImageIcon,
    MapPin,
    Navigation,
    Phone,
    Tag,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import { WISATA_ITEMS } from '../data/wisataData';

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

function InfoItem({ icon: Icon, label, children }) {
    return (
        <div className="flex items-start gap-4 border-b border-border py-5 last:border-b-0">
            <div className="flex size-11 shrink-0 items-center justify-center rounded-xl bg-primary-soft text-primary">
                <Icon className="size-5" />
            </div>

            <div className="min-w-0">
                <p className="text-sm font-medium text-muted-foreground">
                    {label}
                </p>

                <div className="mt-1 break-words font-semibold leading-7 text-foreground">
                    {children}
                </div>
            </div>
        </div>
    );
}

export default function DetailWisata() {
    const { slug } = useParams();

    const wisata = WISATA_ITEMS.find(
        (item) => item.slug === slug,
    );

    if (!wisata) {
        return <Navigate to="/404" replace />;
    }

    const isiArtikel = Array.isArray(wisata.isi)
        ? wisata.isi
        : [];

    return (
        <div className="min-h-screen bg-background">
            <Navbar />

            <main>
                <section className="border-b border-border bg-primary-soft/50">
                    <div className="container-page py-8 md:py-10">
                        <Link
                            to="/wisata"
                            className="inline-flex items-center gap-2 font-semibold text-primary transition hover:gap-3"
                        >
                            <ArrowLeft className="size-5" />
                            Kembali ke Info Wisata
                        </Link>
                    </div>
                </section>

                <section className="container-page py-10 md:py-14">
                    <article className="mx-auto max-w-6xl">
                        <div className="overflow-hidden rounded-3xl border border-border bg-card shadow-sm">
                            <div className="aspect-[16/8] w-full overflow-hidden bg-muted">
                                {wisata.foto_utama ? (
                                    <img
                                        src={wisata.foto_utama}
                                        alt={wisata.nama_spot}
                                        className="size-full object-cover"
                                    />
                                ) : (
                                    <div className="flex size-full flex-col items-center justify-center gap-3 text-muted-foreground">
                                        <ImageIcon className="size-14" />
                                        <p>Foto belum tersedia</p>
                                    </div>
                                )}
                            </div>

                            <div className="p-6 md:p-10">
                                <div className="flex flex-wrap items-center gap-3">
                                    <span
                                        className={`inline-flex rounded-full px-4 py-1.5 text-sm font-semibold ${warnaKategori(
                                            wisata.kategori,
                                        )}`}
                                    >
                                        {wisata.kategori}
                                    </span>

                                    <span
                                        className={`inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-semibold ${
                                            wisata.status_tampil
                                                ? 'bg-emerald-100 text-emerald-700'
                                                : 'bg-slate-100 text-slate-600'
                                        }`}
                                    >
                                        {wisata.status_tampil ? (
                                            <Eye className="size-4" />
                                        ) : (
                                            <EyeOff className="size-4" />
                                        )}

                                        {wisata.status_tampil
                                            ? 'Ditampilkan'
                                            : 'Tidak ditampilkan'}
                                    </span>
                                </div>

                                <h1 className="mt-5 font-display text-4xl leading-tight text-foreground md:text-5xl">
                                    {wisata.nama_spot}
                                </h1>

                                <div className="mt-5 flex items-start gap-2 text-muted-foreground">
                                    <MapPin className="mt-0.5 size-5 shrink-0 text-primary" />

                                    <p className="leading-7">
                                        {wisata.lokasi}
                                    </p>
                                </div>

                                <div className="mt-10 grid gap-10 lg:grid-cols-[minmax(0,1fr)_340px]">
                                    <div>
                                        <section>
                                            <h2 className="font-display text-2xl text-foreground">
                                                Deskripsi
                                            </h2>

                                            <p className="mt-4 whitespace-pre-line text-base leading-8 text-muted-foreground md:text-lg">
                                                {wisata.deskripsi}
                                            </p>
                                        </section>

                                        {isiArtikel.length > 0 && (
                                            <section className="mt-9 border-t border-border pt-8">
                                                <h2 className="font-display text-2xl text-foreground">
                                                    Informasi Selengkapnya
                                                </h2>

                                                <div className="mt-5 space-y-5">
                                                    {isiArtikel.map(
                                                        (
                                                            paragraf,
                                                            index,
                                                        ) => (
                                                            <p
                                                                key={index}
                                                                className="text-base leading-8 text-muted-foreground md:text-lg"
                                                            >
                                                                {
                                                                    paragraf
                                                                }
                                                            </p>
                                                        ),
                                                    )}
                                                </div>
                                            </section>
                                        )}
                                    </div>

                                    <aside className="h-fit rounded-2xl border border-border bg-background px-5 md:px-6 lg:sticky lg:top-24">
                                        <InfoItem
                                            icon={Tag}
                                            label="Kategori"
                                        >
                                            {wisata.kategori ||
                                                'Belum tersedia'}
                                        </InfoItem>

                                        <InfoItem
                                            icon={MapPin}
                                            label="Lokasi"
                                        >
                                            {wisata.lokasi ||
                                                'Belum tersedia'}
                                        </InfoItem>

                                        <InfoItem
                                            icon={Navigation}
                                            label="Koordinat"
                                        >
                                            {wisata.koordinat ||
                                                'Belum tersedia'}
                                        </InfoItem>

                                        <InfoItem
                                            icon={Clock3}
                                            label="Jam Operasional"
                                        >
                                            {wisata.jam_operasional ||
                                                'Belum tersedia'}
                                        </InfoItem>

                                        <InfoItem
                                            icon={Phone}
                                            label="Kontak"
                                        >
                                            {wisata.kontak ||
                                                'Belum tersedia'}
                                        </InfoItem>

                                        <InfoItem
                                            icon={
                                                wisata.status_tampil
                                                    ? Eye
                                                    : EyeOff
                                            }
                                            label="Status Tampil"
                                        >
                                            <span
                                                className={
                                                    wisata.status_tampil
                                                        ? 'text-emerald-700'
                                                        : 'text-muted-foreground'
                                                }
                                            >
                                                {wisata.status_tampil
                                                    ? 'Ditampilkan'
                                                    : 'Tidak ditampilkan'}
                                            </span>
                                        </InfoItem>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </main>

            <Footer />
        </div>
    );
}