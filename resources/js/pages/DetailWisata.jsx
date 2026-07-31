import { Link, Navigate, useParams } from 'react-router-dom';
import { useState } from 'react';
import {
    ArrowLeft,
    Building2,
    Clock3,
    ExternalLink,
    ImageIcon,
    MapPin,
    Phone,
    Share2,
    Tag,
    UserRound,
    Utensils,
} from 'lucide-react';

import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import {
    useWisataDetail,
    warnaKategoriWisata,
    kategoriEn,
} from '../lib/wisata-api';

function InfoCard({ icon: Icon, label, children }) {
    return (
        <div className="flex items-start gap-5 rounded-2xl border border-border bg-background px-6 py-6">
            <div className="flex size-12 shrink-0 items-center justify-center rounded-xl bg-primary-soft text-primary">
                <Icon className="size-5" />
            </div>

            <div className="min-w-0 flex-1">
                <h3 className="text-base font-semibold text-foreground">
                    {label}
                </h3>

                <div className="mt-2 break-words text-base leading-7 text-muted-foreground">
                    {children}
                </div>
            </div>
        </div>
    );
}

function isHttpUrl(value) {
    return /^https?:\/\//i.test(value ?? '');
}

export default function DetailWisata() {
    const { slug } = useParams();

    const {
        data: wisata,
        isLoading,
        isError,
    } = useWisataDetail(slug);

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

    const namaSpot = bahasaInggris
        ? wisata.nama_spot_en || wisata.nama_spot
        : wisata.nama_spot;

    const deskripsi = bahasaInggris
        ? wisata.deskripsi_en || wisata.deskripsi
        : wisata.deskripsi;

    const lokasi = bahasaInggris
        ? wisata.lokasi_en || wisata.lokasi
        : wisata.lokasi;

    const jamOperasional = bahasaInggris
        ? wisata.jam_operasional_en || wisata.jam_operasional
        : wisata.jam_operasional;

    const kontak = bahasaInggris
        ? wisata.kontak_en || wisata.kontak
        : wisata.kontak;

    const googleMapsUrl =
        wisata.google_maps ||
        (wisata.koordinat
            ? `https://www.google.com/maps?q=${encodeURIComponent(
                  wisata.koordinat,
              )}`
            : null);

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
                                        alt={namaSpot}
                                        className="size-full object-cover"
                                    />
                                ) : (
                                    <div className="flex size-full flex-col items-center justify-center gap-3 text-muted-foreground">
                                        <ImageIcon className="size-14" />

                                        <p>
                                            {bahasaInggris
                                                ? 'Photo not available'
                                                : 'Foto belum tersedia'}
                                        </p>
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
                                            ? kategoriEn(wisata.kategori)
                                            : wisata.kategori}
                                    </span>

                                    <button
                                        type="button"
                                        onClick={() =>
                                            setBahasaInggris(
                                                (previousValue) =>
                                                    !previousValue,
                                            )
                                        }
                                        className="inline-flex rounded-full border border-primary px-4 py-1.5 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white"
                                    >
                                        {bahasaInggris ? 'ID' : 'EN'}
                                    </button>
                                </div>

                                <h1 className="mt-5 font-display text-4xl leading-tight text-foreground md:text-5xl">
                                    {namaSpot}
                                </h1>

                                <div className="mt-5 flex items-start gap-2 text-muted-foreground">
                                    <MapPin className="mt-0.5 size-5 shrink-0 text-primary" />

                                    <p className="leading-7">
                                        {lokasi ||
                                            (bahasaInggris
                                                ? 'Location not available'
                                                : 'Lokasi belum tersedia')}
                                    </p>
                                </div>

                                <section className="mt-10">
                                    <h2 className="font-display text-2xl text-foreground">
                                        {bahasaInggris
                                            ? 'Description'
                                            : 'Deskripsi'}
                                    </h2>

                                    <p className="mt-4 max-w-4xl whitespace-pre-line text-base leading-8 text-muted-foreground md:text-lg">
                                        {deskripsi ||
                                            (bahasaInggris
                                                ? 'Description not available.'
                                                : 'Deskripsi belum tersedia.')}
                                    </p>
                                </section>

                                <section className="mt-12 border-t border-border pt-10">
                                    <h2 className="text-xl font-semibold text-foreground">
                                        {bahasaInggris
                                            ? 'Tourism Information'
                                            : 'Informasi Wisata'}
                                    </h2>

                                    <div className="mt-7 grid gap-5">
                                        <InfoCard
                                            icon={Tag}
                                            label={
                                                bahasaInggris
                                                    ? 'Category'
                                                    : 'Kategori'
                                            }
                                        >
                                            {bahasaInggris
                                                ? kategoriEn(wisata.kategori)
                                                : wisata.kategori ||
                                                  'Belum tersedia'}
                                        </InfoCard>

                                        <InfoCard
                                            icon={MapPin}
                                            label={
                                                bahasaInggris
                                                    ? 'Location'
                                                    : 'Lokasi'
                                            }
                                        >
                                            {lokasi ||
                                                (bahasaInggris
                                                    ? 'Not available'
                                                    : 'Belum tersedia')}
                                        </InfoCard>

                                        <InfoCard
                                            icon={ExternalLink}
                                            label="Google Maps"
                                        >
                                            {googleMapsUrl ? (
                                                <a
                                                    href={googleMapsUrl}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    className="inline-flex items-center gap-2 font-medium text-primary hover:underline"
                                                >
                                                    {bahasaInggris
                                                        ? 'Open location in Google Maps'
                                                        : 'Buka lokasi di Google Maps'}

                                                    <ExternalLink className="size-4" />
                                                </a>
                                            ) : (
                                                bahasaInggris
                                                    ? 'Not available'
                                                    : 'Belum tersedia'
                                            )}
                                        </InfoCard>

                                        <InfoCard
                                            icon={Clock3}
                                            label={
                                                bahasaInggris
                                                    ? 'Opening Hours'
                                                    : 'Jam Operasional'
                                            }
                                        >
                                            {jamOperasional ||
                                                (bahasaInggris
                                                    ? 'Not available'
                                                    : 'Belum tersedia')}
                                        </InfoCard>

                                        <InfoCard
                                            icon={Phone}
                                            label={
                                                bahasaInggris
                                                    ? 'Contact'
                                                    : 'Kontak'
                                            }
                                        >
                                            {kontak ||
                                                (bahasaInggris
                                                    ? 'Not available'
                                                    : 'Belum tersedia')}
                                        </InfoCard>

                                        <InfoCard
                                            icon={Share2}
                                            label={
                                                bahasaInggris
                                                    ? 'Social Media'
                                                    : 'Sosial Media'
                                            }
                                        >
                                            {wisata.sosial_media ? (
                                                isHttpUrl(
                                                    wisata.sosial_media,
                                                ) ? (
                                                    <a
                                                        href={
                                                            wisata.sosial_media
                                                        }
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        className="inline-flex items-center gap-2 font-medium text-primary hover:underline"
                                                    >
                                                        {
                                                            wisata.sosial_media
                                                        }

                                                        <ExternalLink className="size-4" />
                                                    </a>
                                                ) : (
                                                    wisata.sosial_media
                                                )
                                            ) : bahasaInggris ? (
                                                'Not available'
                                            ) : (
                                                'Belum tersedia'
                                            )}
                                        </InfoCard>

                                        <InfoCard
                                            icon={Utensils}
                                            label="Menu"
                                        >
                                            <span className="whitespace-pre-line">
                                                {wisata.menu ||
                                                    (bahasaInggris
                                                        ? 'Not available'
                                                        : 'Belum tersedia')}
                                            </span>
                                        </InfoCard>

                                        <InfoCard
                                            icon={Building2}
                                            label={
                                                bahasaInggris
                                                    ? 'Facilities'
                                                    : 'Fasilitas'
                                            }
                                        >
                                            <span className="whitespace-pre-line">
                                                {wisata.fasilitas ||
                                                    (bahasaInggris
                                                        ? 'Not available'
                                                        : 'Belum tersedia')}
                                            </span>
                                        </InfoCard>

                                        <InfoCard
                                            icon={UserRound}
                                            label={
                                                bahasaInggris
                                                    ? 'Source Person'
                                                    : 'Narasumber'
                                            }
                                        >
                                            {wisata.narasumber ||
                                                (bahasaInggris
                                                    ? 'Not available'
                                                    : 'Belum tersedia')}
                                        </InfoCard>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </article>
                </section>
            </main>

            <Footer />
        </div>
    );
}