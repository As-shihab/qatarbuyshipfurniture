import React from 'react';
import Image from 'next/image';

export default function Testimonials() {

    return (
        <section className="px-4 md:px-0 dark:bg-darkmode">
            <div className="container lg:max-w-screen-xl md:max-w-screen-md  px-8 mx-auto py-12 flex flex-col-reverse md:flex-row items-center justify-between">
                <div className="flex justify-between">
                    <div className="flex-1 lg:block hidden" data-aos="fade-right">
                        <Image
                            src="/images/testimonial/vector-smart.png"
                            alt="testimonial"
                            width={451}
                            height={470}
                            quality={100}
                            style={{ width: "auto", height: "auto" }}
                        />
                    </div>
                    <div className="flex-1" data-aos="fade-left">
                        <Image
                            src="/images/testimonial/quote.svg"
                            alt="quote"
                            className="mb-4 md:mb-6"
                            height={135}
                            width={135}
                        />
                        <p className="text-lg md:text-2xl text-gray mb-6 md:mb-12">
                            Letraset sheets containing Lorem Ipsum passages and more recently
                            with desktop publishing Various versions have evolved over the
                            years, sometimes
                        </p>
                        <p className="text-lg md:text-2xl">Stephanie Sue</p>
                        <p className="text-gray text-lg md:text-xl">Designation</p>
                    </div>
                </div>
            </div>
        </section>
    );
}
