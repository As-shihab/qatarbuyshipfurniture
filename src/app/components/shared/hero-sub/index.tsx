import React, { FC } from "react";
import Breadcrumb from "../../breadcrumb";
import { BreadcrumbLink } from "@/app/types/data/breadcrumb";

interface HeroSubProps {
    title: string;
    description: string;
    breadcrumbLinks: BreadcrumbLink[];
}

const HeroSub: FC<HeroSubProps> = ({ title, description, breadcrumbLinks }) => {

    return (
        <>
            <section className=" text-center bg-cover pt-36 pb-20 relative bg-gradient-to-b from-white from-10% dark:from-darkmode to-herobg to-90% dark:to-darklight overflow-x-hidden" >
                <h2 className="text-midnight_text text-[50px] leading-[1.2] relative font-bold dark:text-white capitalize">{title}</h2>
                <p className="text-lg text-gray font-normal max-w-md w-full mx-auto mt-7 mb-12 sm:px-0 px-4">
                    {description}
                </p>
                <Breadcrumb links={breadcrumbLinks} />
            </section>
        </>
    );
};

export default HeroSub;