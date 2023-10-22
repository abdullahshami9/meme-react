import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        gender: null,
        date_of_birth: '', // New field for date of birth
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('register'));
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <form onSubmit={submit}>
                <div>
                    <InputLabel htmlFor="name" value="Name" />
                    <TextInput
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                    />
                    <InputError message={errors.name} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        onChange={(e) => setData('email', e.target.value)}
                        required
                    />
                    <InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />
                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password_confirmation" value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        required
                    />
                    <InputError message={errors.password_confirmation} className="mt-2" />
                </div>

                <div className='mt-4'>
                    <div className="flex items-center">
                        <InputLabel value="Date of Birth" />
                        <span className="text-xs text-gray-500 ml-1">(e.g., 01/01/2000)</span>
                    </div>
                    {/* Dropdowns for date, month, and year */}
                    <div className="flex">
                        <select
                            style={{ borderRadius: 10 }}
                            name="date"
                            value={data.date_of_birth.split('/')[0]}
                            onChange={(e) => {
                                const newValue = e.target.value + '/' + data.date_of_birth.split('/')[1] + '/' + data.date_of_birth.split('/')[2];
                                setData('date_of_birth', newValue);
                            }}
                            className="mr-2"
                        >
                            <option value="" disabled>Day</option>
                            {Array.from({ length: 31 }, (_, i) => (
                                <option key={i + 1} value={i + 1}>{i + 1}</option>
                            ))}
                        </select>
                        <select
                            style={{ borderRadius: 10 }}
                            name="month"
                            value={data.date_of_birth.split('/')[1]}
                            onChange={(e) => {
                                const newValue = data.date_of_birth.split('/')[0] + '/' + e.target.value + '/' + data.date_of_birth.split('/')[2];
                                setData('date_of_birth', newValue);
                            }}
                            className="mr-2"
                        >
                            <option value="" disabled>Month</option>
                            {Array.from({ length: 12 }, (_, i) => (
                                <option key={i + 1} value={i + 1}>{i + 1}</option>
                            ))}
                        </select>
                        <select
                            style={{ borderRadius: 10 }}
                            name="year"
                            value={data.date_of_birth.split('/')[2]}
                            onChange={(e) => {
                                const newValue = data.date_of_birth.split('/')[0] + '/' + data.date_of_birth.split('/')[1] + '/' + e.target.value;
                                setData('date_of_birth', newValue);
                            }}
                        >
                            <option value="" disabled>Year</option>
                            {Array.from({ length: 100 }, (_, i) => (
                                <option key={i + 1900} value={i + 1900}>{i + 1900}</option>
                            ))}
                        </select>
                    </div>
                    <InputError message={errors.date_of_birth} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel value="Gender" />
                    {/* Radio buttons for gender in a row */}
                    <div className="flex">

                        <div

                            style={{ borderRadius: 10, borderWidth: 2, borderColor: 'black', margin: 10 }}>


                            <label
                                style={{ paddingLeft: 10,paddingVertical:20 }}
                                className="mr-4">

                                <input
                                    type="radio"
                                    name="gender"
                                    value="1"
                                    checked={data.gender === "1"}
                                    onChange={(e) => setData('gender', e.target.value)}
                                />
                                Male
                            </label>

                        </div>
                        <div
                         style={{ borderRadius: 10, borderWidth: 2, borderColor: 'black', margin: 10 }}>
                            
                            <label 
                            style={{ paddingLeft: 10,paddingVertical:20 }}
                            className="mr-4">
                                <input
                                    type="radio"
                                    name="gender"
                                    value="2"
                                    checked={data.gender === "2"}
                                    onChange={(e) => setData('gender', e.target.value)}
                                />
                                Female
                            </label>
                        </div>
                        <div
                         style={{ borderRadius: 10, borderWidth: 2, borderColor: 'black', margin: 10 }}>
                        <label
                        style={{ paddingLeft: 10,paddingVertical:20 }}>
                            <input
                                type="radio"
                                name="gender"
                                value="3"
                                checked={data.gender === "3"}
                                onChange={(e) => setData('gender', e.target.value)}
                            />
                            Prefer Not to Say
                        </label>
                        </div>
                    </div>
                </div>



                <div className="flex items-center justify-end mt-4">
                    <Link
                        href={route('login')}
                        className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton className="ml-4" disabled={processing}>
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
