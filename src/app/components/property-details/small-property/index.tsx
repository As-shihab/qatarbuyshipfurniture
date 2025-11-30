"use client";
import React, { useEffect, useState } from 'react';
import Image from 'next/image';

export default function Smallproperty() {
const [data, setData] = useState<any[]>([]);
    useEffect(() => {
            const fetchData = async () => {
                try {
                    const res = await fetch('/api/pagedata')
                    if (!res.ok) throw new Error('Failed to fetch')
    
                    const data = await res.json()
                    setData(data?.data || [])
                } catch (error) {
                    console.error('Error fetching services:', error)
                }
            }
    
            fetchData()
        }, [])

    return (
        <section className='py-[120px] bg-[#2F73F2]'>
            <div className="max-w-[1200px] mx-auto px-4">
                <div className="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    {data.map((property, index) => (
                        <div key={index} className="image-item px-[15px]" data-aos="fade-up">
                            <Image src={property.src1} alt={property.alt} height={85} width={85} />
                            <p className="text-[22px] text-white font-semibold mt-2">{property.name}</p>
                            <p className="text-[16px] text-white text-gray-600">{property.count} Properties</p>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
