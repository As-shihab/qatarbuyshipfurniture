import React from 'react';

interface MainHeadingProps {
    title: string;
}

const MainHeading: React.FC<MainHeadingProps> = ({ title }) => {

    return (
        <div className='py-16 md:py-20 lg:lg:py-24'>
            <div className='lg:max-w-screen-xl max-w-screen-md flex justify-center items-center mx-auto'>
                <div className='px-4 max-w-43.75'>
                    <p className='text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-center font-bold mb-4 sm:mb-6 md:mb-8' data-aos="fade-up">
                        Welcome to KD-9 District {title}
                    </p>
                </div>
            </div>
        </div>
    );
}

export default MainHeading;