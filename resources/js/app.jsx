import './bootstrap';
import '../css/app.css';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';

import Beranda from './pages/Beranda';
import KearifanLokal from './pages/KearifanLokal';
import Wisata from './pages/Wisata';
import UMKM from './pages/UMKM';

const queryClient = new QueryClient();

function App() {
    return (
        <QueryClientProvider client={queryClient}>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Beranda />} />
                    <Route path="/kearifan-lokal" element={<KearifanLokal />} />
                    <Route path="/wisata" element={<Wisata />} />
                    <Route path="/umkm" element={<UMKM />} />
                </Routes>
            </BrowserRouter>
        </QueryClientProvider>
    );
}

const root = document.getElementById('app');

if (root) {
    createRoot(root).render(<App />);
}