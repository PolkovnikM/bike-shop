import { useState, useEffect } from 'react';
import axios from 'axios';

function PopularSlider() {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('/bike-shop/backend/api/products.php')
            .then(res => {
                setProducts(res.data.data || []);
                setLoading(false);
            })
            .catch(() => setLoading(false));
    }, []);
    if (loading) {
        return <div className="widget">Загрузка популярных велосипедов...</div>;
    }

    if (!products || products.length === 0) {
        return <div className="widget">Нет популярных велосипедов</div>;
    }

    return (
        <div className="widget">
            <h3>Популярные велосипеды</h3>
            <div style={{ display: 'flex', gap: '20px', flexWrap: 'wrap' }}>
                {products.slice(0, 6).map(product => (
                    <div key={product.id} style={{ background: '#1a1a1a', padding: '15px', borderRadius: '12px', flex: '1 1 200px' }}>
                        <h4>{product.name}</h4>
                        <p style={{ color: '#00ff9d', fontSize: '18px' }}>{product.price.toLocaleString()} ₽</p>
                    </div>
                ))}
            </div>
        </div>
    );
}

export default PopularSlider;