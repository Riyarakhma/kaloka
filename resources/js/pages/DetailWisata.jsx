import { Link, Navigate, useParams } from 'react-router-dom';
import { useState } from 'react';
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
import { useWisataDetail, warnaKategoriWisata, kategoriEn } from '../lib/wisata-api';

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

    const { data: wisata, isLoading, isError } = useWisataDetail(slug);
    const [bahasaInggris, setBahasaInggris] = useState(false);

    if (isLoading) {
        return (
            <div className="min-h-screen bg-background">
                <Navbar />
                <div className="container-page py-20 text-center text-muted-foreground">
                    {bahasaInggris ? 'Loading...' : 'Memuat...'}
                </div>
                <Footer />
            </div>
        );
    }

    if (isError || !wisata) {
        return <Navigate to="/404" replace />;
    }

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
                                        <p>{bahasaInggris ? 'Photo not available' : 'Foto belum tersedia'}</p>
                                    </div>
                                )}
                            </div>

                            <div className="p-6 md:p-10">
                                <div className="flex flex-wrap items-center gap-3">
                                    <span
                                        className={`inline-flex rounded-full px-4 py-1.5 text-sm font-semibold ${warnaKategoriWisata(
                                            wisata.kategori,
                                        )}`}
                                    >
                                        {bahasaInggris
                                            ? (wisata.kategori
                                                  ? kategoriEn(wisata.kategori)
                                                  : '')
                                            : wisata.kategori}
                                    </span>

                                    <span
                                        className={`inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-semibold ${
                                            wisata.boleh_publik
                                                ? 'bg-emerald-100 text-emerald-700'
                                                : 'bg-slate-100 text-slate-600'
                                        }`}
                                    >
                                        {wisata.boleh_publik ? (
                                            <Eye className="size-4" />
                                        ) : (
                                            <EyeOff className="size-4" />
                                        )}

                                        {bahasaInggris
                                            ? (wisata.boleh_publik ? 'Displayed' : 'Not displayed')
                                            : (wisata.boleh_publik ? 'Ditampilkan' : 'Tidak ditampilkan')}
                                    </span>

                                    <button
                                        type="button"
                                        onClick={() =>
                                            setBahasaInggris((v) => !v)
                                        }
                                        className="inline-flex items-center gap-2 rounded-full border border-primary px-4 py-1.5 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white"
                                    >
                                        {bahasaInggris ? 'ID' : 'EN'}
                                    </button>
                                </div>

                                <h1 className="mt-5 font-display text-4xl leading-tight text-foreground md:text-5xl">
                                    {bahasaInggris
                                        ? (wisata.nama_spot_en ||
                                              wisata.nama_spot)
                                        : wisata.nama_spot}
                                </h1>

                                <div className="mt-5 flex items-start gap-2 text-muted-foreground">
                                    <MapPin className="mt-0.5 size-5 shrink-0 text-primary" />

                                    <p className="leading-7">
                                        {bahasaInggris
                                            ? (wisata.lokasi_en ||
                                                  wisata.lokasi)
                                            : wisata.lokasi}
                                    </p>
                                </div>

                                <div className="mt-10 grid gap-10 lg:grid-cols-[minmax(0,1fr)_340px]">
                                    <div>
                                        <section>
                                            <h2 className="font-display text-2xl text-foreground">
                                                {bahasaInggris ? 'Description' : 'Deskripsi'}
                                            </h2>

                                            <p className="mt-4 whitespace-pre-line text-base leading-8 text-muted-foreground md:text-lg">
                                                {bahasaInggris
                                                    ? (wisata.deskripsi_en ||
                                                          wisata.deskripsi)
                                                    : wisata.deskripsi}
                                            </p>
                                        </section>
                                    </div>

                                    <aside className="h-fit rounded-2xl border border-border bg-background px-5 md:px-6 lg:sticky lg:top-24">
                                        <InfoItem
                                            icon={Tag}
                                            label={bahasaInggris ? 'Category' : 'Kategori'}
                                        >
                                            {bahasaInggris
                                                ? (wisata.kategori
                                                      ? kategoriEn(
                                                            wisata.kategori,
                                                        )
                                                      : 'Not available')
                                                : (wisata.kategori ||
                                                  'Belum tersedia')}
                                        </InfoItem>

                                        <InfoItem
                                            icon={MapPin}
                                            label={bahasaInggris ? 'Location' : 'Lokasi'}
                                        >
                                            {bahasaInggris
                                                ? (wisata.lokasi_en ||
                                                      wisata.lokasi ||
                                                      'Not available')
                                                : (wisata.lokasi ||
                                                  'Belum tersedia')}
                                        </InfoItem>

                                        <InfoItem
                                            icon={Navigation}
                                            label={bahasaInggris ? 'Coordinates' : 'Koordinat'}
                                        >
                                            {wisata.koordinat ||
                                                (bahasaInggris ? 'Not available' : 'Belum tersedia')}
                                        </InfoItem>

                                        <InfoItem
                                            icon={Clock3}
                                            label={bahasaInggris ? 'Opening Hours' : 'Jam Operasional'}
                                        >
                                            {bahasaInggris
                                                ? (wisata.jam_operasional_en ||
                                                      wisata.jam_operasional ||
                                                      'Not available')
                                                : (wisata.jam_operasional ||
                                                  'Belum tersedia')}
                                        </InfoItem>

                                        <InfoItem
                                            icon={Phone}
                                            label={bahasaInggris ? 'Contact' : 'Kontak'}
                                        >
                                            {bahasaInggris
                                                ? (wisata.kontak_en ||
                                                      wisata.kontak ||
                                                      'Not available')
                                                : (wisata.kontak ||
                                                  'Belum tersedia')}
                                        </InfoItem>

                                        <InfoItem
                                            icon={
                                                wisata.boleh_publik
                                                    ? Eye
                                                    : EyeOff
                                            }
                                            label={bahasaInggris ? 'Display Status' : 'Status Tampil'}
                                        >
                                            <span
                                                className={
                                                    wisata.boleh_publik
                                                        ? 'text-emerald-700'
                                                        : 'text-muted-foreground'
                                                }
                                            >
                                                {bahasaInggris
                                                    ? (wisata.boleh_publik ? 'Displayed' : 'Not displayed')
                                                    : (wisata.boleh_publik ? 'Ditampilkan' : 'Tidak ditampilkan')}
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