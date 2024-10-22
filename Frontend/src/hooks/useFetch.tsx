import { useEffect, useState } from "react";

export const useFetch = <T,>(url: string,) => {
    const [data, setData] = useState<T[]>([]);
    const[loading, setLoading] = useState(true);
    const[error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchData = async () => {
            try{
                const response = await fetch(url);
                if(!response.ok){
                    throw new Error(`Error: ${response.status}`);
            }
            const reulst = await response.json();
            setData(reulst);
        } catch (error) {
            setError((error as Error).message);
        } finally {
            setLoading(false);
        }
    };
    fetchData();
    }, [url]);
    return {data, loading, error, setData};
}