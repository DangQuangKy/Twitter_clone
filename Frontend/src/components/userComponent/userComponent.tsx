import React, { useEffect, useState } from 'react';
import { User } from '../../types/user.type';

const UserProfile: React.FC = () => {
    const [user, setUser] = useState<User>();
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const token = localStorage.getItem("token");
        const fetchUser = async () => {
            try {
                const response = await fetch("http://127.0.0.1:8000/api/user", {
                    method: "GET",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Content-Type": "application/json",
                    },
                });

                if (!response.ok) {
                    throw new Error("Could not fetch user data");
                }

                const data = await response.json();
                
                setUser(data);
            // eslint-disable-next-line @typescript-eslint/no-unused-vars
            } catch (error) {
                setError("Không thể lấy thông tin người dùng");
            }
        };

        fetchUser();
    }, []); 

    if (error) {
        return <p style={{ color: "red" }}>{error}</p>;
    }

    if (!user) {
        return <p>Đang tải thông tin người dùng...</p>;
    }

    return (
        <div>
            <h1>Thông tin người dùng</h1>
            <p>Tên: {user.name}</p>
            <p>Email: {user.email}</p>
        </div>
    );
};

export default UserProfile;
