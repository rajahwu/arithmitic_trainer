import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import Button from '@/Components/Button';
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";

export default function Select({ auth }) {
    const { data, setData, post, processing, errors } = useForm({
        selected: {
            type: '', // (practice | assestment)
            category: '' // (standard | quiz | evaluation | exam)
        }
    });
    
    const handleClick = (value) => {
        const [type, category] = value.split(',');
        setData('selected', { type, category });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/exercise/settings/' + data.selected['type'] + '/' + data.selected['category'], {
            data: {
                selected: data.selected
            }
        });
    };

    return (
        <AuthenticatedLayout 
            user={auth.user}
            header={<h2 className="major-mono-display-regular font-semibold text-2xl text-white dark:text-gray-200 leading-tight">Exercise</h2>}
        >
            <div className="flex items-center justify-center m-5">
                <form  onSubmit={handleSubmit}>
                    <div className="spline-sans-mono text-[var(--primary-color)] flex flex-col gap-5 items-center text-center md:flex-row  md:gap-16 text-white">
                        <div>
                            <p className="m-2 uppercase text-[var(--primary-color)]">Practice</p>
                            <Button buttonvalue="Standard" className="p-5 m-2" type="button" onClick={() => handleClick('practice,standard')} />
                        </div> 
                        <div>
                            <p className="m-2 uppercase text-[var(--primary-color)]">Assessments</p>
                                <div className="flex gap-5 items-center">
                                <Button buttonvalue="Quiz" className="p-5 m-2" type="button" onClick={() => handleClick('assessment,quiz')} />
                                <Button buttonvalue="Eval" className="p-5 m-2" type="button" onClick={() => handleClick('assessment,evaluation')} />
                                <Button buttonvalue="Exam" className="p-5 m-2" type="button" onClick={() => handleClick('assessment,exam')} />
                                </div>
                        </div>
                        <PrimaryButton buttonvalue="Exam" className="md:flex md:self-end h-6 p-3 bg-[var(--primary-color)] rounded-xl text-2xl" type="submit">
                            Select
                        </PrimaryButton> 
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
