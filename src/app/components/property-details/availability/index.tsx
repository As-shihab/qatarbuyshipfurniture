
import React from 'react';
import Link from 'next/link';

export default function Availability() {
    return (
        <div className='bg-[#F0F6FA] dark:bg-[#111929] lg:py-24 py-16'>
            <div className='max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8'>
                <p className='mb-[16px] text-[24px] sm:text-[36px] justify-center flex font-bold'>
                    Available
                </p>
                <p className='mb-10 sm:mb-3.75 text-base sm:text-xl text-gray justify-center flex'>
                    Sometimes by accident, sometimes chunks as necessary.
                </p>

                <div className="overflow-x-auto">
                    <table className="w-full text-center text-sm sm:text-lg text-gray">
                        <thead>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <th className="py-2 sm:py-4 px-2 text-center">Residence</th>
                                <th className="py-2 sm:py-4 px-2 text-center">Room</th>
                                <th className="py-2 sm:py-4 px-2 text-center">Bath</th>
                                <th className="py-2 sm:py-4 px-2 text-center">View</th>
                                <th className="py-2 sm:py-4 px-2 text-center">Floor</th>
                                <th className="py-2 sm:py-4 px-2 text-center">Terrace</th>
                                <th className="py-2 sm:py-4 px-2 text-center">Layout</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <td className="py-2 sm:py-4 px-2">Amazon</td>
                                <td className="py-2 sm:py-4 px-2">4</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">
                                    <Link href="/properties/properties-list" className='flex items-center justify-center hover:text-primary'>
                                        View More
                                        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <td className="py-2 sm:py-4 px-2">Danube</td>
                                <td className="py-2 sm:py-4 px-2">4</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">3</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">
                                    <Link href="/properties/properties-list" className='flex items-center justify-center hover:text-primary'>
                                        View More
                                        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <td className="py-2 sm:py-4 px-2">Volga</td>
                                <td className="py-2 sm:py-4 px-2">3</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">4</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">
                                    <Link href="/properties/properties-list" className='flex items-center justify-center hover:text-primary'>
                                        View More
                                        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <td className="py-2 sm:py-4 px-2">Seine</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">
                                    <Link href="/properties/properties-list" className='flex items-center justify-center hover:text-primary'>
                                        View More
                                        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <td className="py-2 sm:py-4 px-2">Rhine</td>
                                <td className="py-2 sm:py-4 px-2">4</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">
                                    <Link href="/properties/properties-list" className='flex items-center justify-center hover:text-primary'>
                                        View More
                                        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <td className="py-2 sm:py-4 px-2">Hudson</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">3</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">
                                    <Link href="/properties/properties-list" className='flex items-center justify-center hover:text-primary'>
                                        View More
                                        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                            <tr className='border-b border-border dark:border-dark_border'>
                                <td className="py-2 sm:py-4 px-2">Tigris</td>
                                <td className="py-2 sm:py-4 px-2">3</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">2</td>
                                <td className="py-2 sm:py-4 px-2">1</td>
                                <td className="py-2 sm:py-4 px-2">
                                    <Link href="/properties/properties-list" className='flex items-center justify-center hover:text-primary'>
                                        View More
                                        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}