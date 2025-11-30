import { useState } from 'react';
import Link from 'next/link';
import { HeaderItem } from '../../../../types/layout/menu';
import { usePathname, useRouter } from 'next/navigation';

const MobileHeaderLink: React.FC<{ item: HeaderItem }> = ({ item }) => {
  const [submenuOpen, setSubmenuOpen] = useState(false);

  const handleToggle = () => {
    setSubmenuOpen(!submenuOpen);
  };
  const router = useRouter();

  const handlenav = () => {
    router.push(item.href)
  }

  const path = usePathname();

  return (
    <div className="relative w-full">
      <button
        onClick={item.submenu ? handleToggle : handlenav}
        className={`flex items-center justify-between w-full py-2 px-3 rounded-md text-black focus:outline-none dark:text-white dark:text-opacity-60 ${path === item.href ? 'bg-primary text-white dark:bg-primary dark:text-white dark:text-opacity-100' : ' text-black dark:text-white '} ${path.startsWith(`/${item.label.toLowerCase()}`) ? "bg-primary text-white dark:bg-primary dark:text-white dark:text-opacity-100 " : null}`}
      >
        {item.label}
        {item.submenu && (
          <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="m7 10l5 5l5-5" />
          </svg>
        )}
      </button>
      {submenuOpen && item.submenu && (
        <div className="bg-white dark:bg-darkmode py-2 px-3 w-full">
          {item.submenu.map((subItem, index) => (
            <Link key={index} href={subItem.href} className={`block py-2 px-3  ${subItem.href === path ? '!text-primary dark:text-primary' : 'text-gray'}`}>
              {subItem.label}
            </Link>
          ))}
        </div>
      )}
    </div>
  );
};

export default MobileHeaderLink;
