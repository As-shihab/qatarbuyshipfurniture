"use client";
import Image from 'next/image';
import React, { useEffect, useState } from 'react';

export default function Features() {
    const [propertiesData, setPropertiesData] = useState<any[]>([]);
    const [pageData, setPageData] = useState<any[]>([]);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const [resProperties, resPage] = await Promise.all([
                    fetch('/api/propertydata'),
                    fetch('/api/pagedata'),
                ]);

                if (!resProperties.ok || !resPage.ok) {
                    throw new Error('Failed to fetch one or more APIs');
                }

                const properties = await resProperties.json();
                const page = await resPage.json();

                setPropertiesData(properties || []);
                setPageData(page.features || {});
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        fetchData();
    }, []);

    const value = propertiesData.filter((item) => {
        return !item.check;
    });



    return (
        <section className='dark:bg-darkmode'>
            <div className="container px-4 lg:max-w-screen-xl md:max-w-screen-md mx-auto flex flex-col md:flex-row justify-between items-center">
                <div className="flex lg:flex-row flex-col lg:gap-0 gap-8 justify-between">
                    <div className='mb-8 md:mb-0 flex-1'>
                        <div className='relative' data-aos="fade-right">
                            <Image
                                src="/images/features/features_iimage.jpg"
                                alt='property'
                                width={640}
                                height={615}
                                style={{ width: "100%", height: "auto" }}
                            />
                            <div className="lg:max-w-96 max-w-37.5 absolute bottom-0 mx-auto left-0 right-0 lg:mr-3.75">
                                {value.map(property => (
                                    <div key={property.id} className="bg-white shadow-lg rounded-t-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                                        <div className='relative'>
                                            <Image
                                                src={property.property_img}
                                                alt="Property Image"
                                                height={235}
                                                width={370}
                                                style={{ width: '100%', height: 'auto' }}
                                            />
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                className='absolute top-[10px] right-[10px] bg-white p-2 rounded-lg'
                                                viewBox="0 0 24 24"
                                                width="38"
                                                height="38"
                                                fill="#2F73F2"
                                            >
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                            </svg>
                                        </div>
                                        <div className="p-4 dark:bg-[#111929]">
                                            <div className="flex dark:text-gray justify-between items-center">
                                                <div className="font-bold text-2xl">{property.property_price}</div>
                                                <div className='text-xs bg-herobg dark:bg-white dark:text-blue-500 py-4 px-8 rounded-lg font-bold'>
                                                    {property.location}
                                                </div>
                                            </div>
                                            <div>
                                                <p className="text-base text-gray">{property.property_title}</p>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                    <div className='flex-1 '>
                        <div className="lg:pl-20 flex flex-col justify-center h-full">
                            <p className='mb-8 md:mb-3.75 text-4xl font-bold text-midnight_text dark:text-white' data-aos="fade-left">Why People Choose Property</p>
                            {pageData.map(feature => (
                                <div key={feature.id} className='flex mb-8 md:mb-3.75 items-center gap-8' data-aos="fade-left" data-aos-delay="100">
                                    <div className="bg-primary/20 p-4 rounded-full flex justify-center items-start">
                                        <Image
                                            src={feature.imgSrc}
                                            alt={feature.title}
                                            height={78}
                                            width={78}
                                        />
                                    </div>
                                    <div className='flex-col'>
                                        <p className='text-2xl mb-2'>{feature.title}</p>
                                        <p className='text-gray text-base'>{feature.description}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}
