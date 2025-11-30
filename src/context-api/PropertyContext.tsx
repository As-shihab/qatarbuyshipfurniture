'use client';

import { Filters } from '@/app/types/property/filtertypes';
import { propertyData } from '@/app/types/property/propertyData';
import React, {
  createContext,
  useState,
  useEffect,
  ReactNode,
  Dispatch,
  SetStateAction
} from 'react';

interface PropertyContextType {
  properties: propertyData[];
  setProperties: Dispatch<SetStateAction<propertyData[]>>;
  filters: Filters;
  setFilters: any;
  updateFilter: (key: keyof Filters, value: string) => void;
}

export const PropertyContext = createContext<PropertyContextType | undefined>(undefined);

export const AppContextProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const [allProperties, setAllProperties] = useState<propertyData[]>([]);
  const [properties, setProperties] = useState<propertyData[]>([]);
  const [filters, setFilters] = useState<Filters>({
    keyword: '',
    location: '',
    region: '',
    status: '',
    category: '',
    beds: '',
    baths: '',
    garages: '',
    tag: '',
  });

  // Fetch properties from the API route
  useEffect(() => {
    const fetchProperties = async () => {
      try {
        const res = await fetch('/api/propertydata');
        const data: propertyData[] = await res.json();
        setAllProperties(data);
        setProperties(data); // set initially unfiltered list
      } catch (error) {
        console.error('Failed to fetch properties:', error);
      }
    };

    fetchProperties();
  }, []);

  // Apply filters whenever `filters` or `allProperties` change
  useEffect(() => {
    const filteredProperties = allProperties.filter((property) => {
      return (
        (!filters.keyword || property.property_title.toLowerCase().includes(filters.keyword.toLowerCase())) &&
        (!filters.location || property.location.toLowerCase() === filters.location.toLowerCase()) &&
        (!filters.tag || property.tag.toLowerCase() === filters.tag.toLowerCase()) &&
        (!filters.status || property.status === filters.status) &&
        (!filters.category || property.category.toLowerCase() === filters.category.toLowerCase()) &&
        (!filters.beds || property.beds === Number(filters.beds)) &&
        (!filters.garages || property.garages === Number(filters.garages))
      );
    });

    setProperties(filteredProperties);
  }, [filters, allProperties]);

  const updateFilter = (key: keyof Filters, value: string) => {
    setFilters((prevFilters) => ({
      ...prevFilters,
      [key]: value,
    }));
  };

  return (
    <PropertyContext.Provider
      value={{
        properties,
        setProperties,
        filters,
        setFilters,
        updateFilter
      }}
    >
      {children}
    </PropertyContext.Provider>
  );
};
