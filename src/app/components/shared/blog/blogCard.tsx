import React, { FC } from "react";
import Image from "next/image";
import { format } from "date-fns";
import Link from "next/link";
import { Blog } from "@/app/types/data/blog";

const BlogCard: FC<{ blog: Blog }> = ({ blog }) => {
    const { title, coverImage, excerpt, date, slug } = blog;
    return (
        <Link href={`/blogs/${slug}`} aria-label="blog cover 5xl:h-full 5xl:inline-block" className="flex gap-4 group">
            <div className="overflow-hidden rounded-lg flex-shrink-0 w-52 h-48">
                <Image
                    src={coverImage!}
                    alt="image"
                    className="transition group-hover:scale-125 w-full h-full object-cover"
                        width={190}
                    height={163}
                />
            </div>
            <div className="ml-4 md:mt-0 md:ml-4 flex-1 flex flex-col justify-evenly">
                <div className="">
                    <span className="text-sm sm:text-base md:text-lg font-medium dark:text-white text-gray leading-loose">
                        {format(new Date(date), "MMM dd, yyyy")}
                    </span>
                    <h3 className="mt-2 text-xl sm:text-[22px] leading-[1.2] md:text-2xl font-medium text-midnight_text dark:text-white group-hover:text-primary">
                        {title}
                    </h3>
                </div>
                <p className="block mt-4 text-primary text-base sm:text-lg">
                    Read More
                </p>
            </div>
        </Link>
    );
};

export default BlogCard;
