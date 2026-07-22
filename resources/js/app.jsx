import './bootstrap';
import '../css/app.css';

import React from 'react';
import { createRoot } from 'react-dom/client';
import {
    BrowserRouter,
    Routes,
    Route,
} from 'react-router-dom';

import {
    QueryClient,
    QueryClientProvider,
} from '@tanstack/react-query';

import Beranda from './pages/Beranda';
import KearifanLokal from './pages/KearifanLokal';
import DetailKearifan from './pages/DetailKearifan';
import Wisata from './pages/Wisata';
import DetailWisata from './pages/DetailWisata';
import UMKM from './pages/UMKM';
import DetailUMKM from './pages/DetailUMKM';

const queryClient = new QueryClient();

function App() {
    return (
        <QueryClientProvider client={queryClient}>
            <BrowserRouter>
                <Routes>
                    {/* Beranda */}
                    <Route
                        path="/"
                        element={<Beranda />}
                    />

                    {/* Kearifan Lokal */}
                    <Route
                        path="/kearifan-lokal"
                        element={<KearifanLokal />}
                    />

                    {/* Detail Kearifan Lokal */}
                    <Route
                        path="/kearifan-lokal/:slug"
                        element={<DetailKearifan />}
                    />

                    {/* Wisata */}
                    <Route
                        path="/wisata"
                        element={<Wisata />}
                    />

                    {/* Detail Wisata */}
                    <Route
                        path="/wisata/:slug"
                        element={<DetailWisata />}
                    />

                    {/* UMKM */}
                    <Route
                        path="/umkm"
                        element={<UMKM />}
                    />

                    {/* Detail UMKM */}
                    <Route
                        path="/umkm/:slug"
                        element={<DetailUMKM />}
                    />

                    {/* 404 */}
                    <Route
                        path="*"
                        element={
                            <div className="flex min-h-screen items-center justify-center px-6 text-center">
                                <h1 className="text-3xl font-bold text-foreground md:text-5xl">
                                    404 | Halaman Tidak Ditemukan
                                </h1>
                            </div>
                        }
                    />
                </Routes>
            </BrowserRouter>
        </QueryClientProvider>
    );
}

const root = document.getElementById('app');

if (root) {
    createRoot(root).render(<App />);
}