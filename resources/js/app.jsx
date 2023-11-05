import './bootstrap';
import '../css/app.css';
import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { BrowserRouter } from 'react-router-dom';
import { DarkModeContextProvider } from './context/darkModeContext';
import { AuthContextProvider } from './context/authContext';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.jsx`, import.meta.glob('./Pages/**/*.jsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(
            <BrowserRouter>
                <App {...props} />
                
                {/* <React.StrictMode>
                    <DarkModeContextProvider>
                        <AuthContextProvider>
                        <App {...props} />
                        </AuthContextProvider>
                    </DarkModeContextProvider>
                </React.StrictMode> */}
            </BrowserRouter>
        );
    },
    progress: {
        color: '#4B5563',
    },
});
