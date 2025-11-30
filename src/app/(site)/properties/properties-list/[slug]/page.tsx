"use client"
import React, { useEffect, useState } from 'react';
import { useParams } from "next/navigation";
import Image from 'next/image';
import CompanyInfo from '@/app/components/home/info';
import Availability from '@/app/components/property-details/availability';
import Tabbar from '@/app/components/property-details/tabbar';
import TextSection from '@/app/components/property-details/text-section';
import DiscoverProperties from '@/app/components/home/property-option';


export default function Details() {
  const { slug } = useParams();
  const [properties, setProperties] = useState<any[]>([])

  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await fetch('/api/propertydata')
        if (!res.ok) throw new Error('Failed to fetch')

        const data = await res.json()
        setProperties(data || [])
      } catch (error) {
        console.error('Error fetching services:', error)
      }
    }

    fetchData()
  }, [])

  const item = properties.find((item) => item.slug === slug);

  const breadcrumbLinks = [
    { href: "/", text: "Home" },
    { href: "/property-list", text: "Property Details" },
  ];
  return (
    <div>
      <section className="bg-cover pt-36 pb-20 relative bg-gradient-to-b from-white from-10% dark:from-darkmode to-herobg to-90% dark:to-darklight overflow-x-hidden" >
        <div className="container mx-auto lg:max-w-screen-xl md:max-w-screen-md">
          <h2 className="text-midnight_text text-4xl lg:text-[50px] leading-[1.2] md:mx-auto md:max-w-60% text-center relative font-bold dark:text-white"> {item?.property_title} </h2>
        </div>
      </section>
      <section>
        <div className='container mx-auto dark:bg-darkmode'>
          <div className="h-[580px] max-w-5xl mx-auto w-full">
            {item?.property_img &&
              <Image
                src={item?.property_img}
                alt={item?.property_title}
                width={1000}
                height={600}
                className='h-full w-full object-cover rounded-lg'
              />}
          </div>
        </div>
      </section>
      <TextSection />
      <CompanyInfo />
      <Tabbar />
      <Availability />
      <DiscoverProperties />
    </div>
  );
}
