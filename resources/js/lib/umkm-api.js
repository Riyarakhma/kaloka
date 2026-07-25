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
                ...item,
                slug: String(item.id),
                foto: item.foto?.[0] ? `/storage/${item.foto[0]}` : null,
            }));
        },
    });
}