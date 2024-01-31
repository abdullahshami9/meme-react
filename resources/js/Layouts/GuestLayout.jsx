import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function Guest({ children }) {
  return (
    <div className="flex justify-center items-center min-h-screen bg-gray-100 dark:bg-gray-900">
      <div className="w-full max-w-md mt-6 px-6 py-4 bg-black dark:bg-gray-800 shadow-md rounded-lg">
        <div className="flex justify-center items-center mb-4">
          <Link href="/">
            <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
          </Link>
        </div>
        {children}
      </div>
    </div>
  );
}
