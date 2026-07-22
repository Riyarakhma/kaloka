import { useQuery } from '@tanstack/react-query';

export function useUmkmItems() {
    return useQuery({
        queryKey: ['umkm'],
        queryFn: async () => {
            const response = await fetch('/api/umkm');

            if (!response.ok) {
                throw new Error('Gagal mengambil data UMKM');
            }

            const result = await response.json();

            return result.data.map((item) => ({
                slug: item.id.toString(),
                nama: item.nama_umkm,
                kategori: item.kategori.toLowerCase(),
                deskripsi: item.deskripsi,
                foto: item.foto?.[0]
                    ? `/storage/${item.foto[0]}`
                    : 'https://placehold.co/600x400',
                pemilik: item.pemilik,
                alamat: item.alamat,
                kontak: item.kontak,
            }));
        },
    });
}