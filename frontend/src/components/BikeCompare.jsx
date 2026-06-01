import { useState, useEffect } from 'react';
import axios from 'axios';

function BikeCompare() {
    const [products, setProducts] = useState([]);
    const [bike1, setBike1] = useState(null);
    const [bike2, setBike2] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('/bike-shop/backend/api/products.php')
            .then(res => {
                setProducts(res.data.data || []);
                setLoading(false);
            })
            .catch(() => setLoading(false));
    }, []);
    const getCategoryName = (category) => {
        const categories = {
            'mountain': 'Горный',
            'road': 'Шоссейный',
            'city': 'Городской',
            'kids': 'Детский',
            'electric': 'Электрический',
            'bmx': 'BMX / Трюковой',
            'hybrid': 'Гибридный'
        };
        return categories[category] || category;
    };

    if (loading) {
        return <div className="widget">Загрузка...</div>;
    }

    return (
        <div className="widget">
            <h3>Сравнение велосипедов</h3>
            <p>Выберите два велосипеда для сравнения</p>
            
            <div className="compare-container">
                <select onChange={(e) => setBike1(products.find(p => p.id === parseInt(e.target.value)))}>
                    <option value="">Велосипед 1</option>
                    {products.map(p => <option key={p.id} value={p.id}>{p.name}</option>)}
                </select>
                <span>VS</span>
                <select onChange={(e) => setBike2(products.find(p => p.id === parseInt(e.target.value)))}>
                    <option value="">Велосипед 2</option>
                    {products.map(p => <option key={p.id} value={p.id}>{p.name}</option>)}
                </select>
            </div>

            {bike1 && bike2 && (
                <div className="compare-result">
                    <table className="compare-table">
                        <thead>
                            <tr>
                                <th>Характеристика</th>
                                <th>{bike1.name}</th>
                                <th>{bike2.name}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Цена</strong></td>
                                <td className="price">{bike1.price.toLocaleString()} ₽</td>
                                <td className="price">{bike2.price.toLocaleString()} ₽</td>
                            </tr>
                            <tr>
                                <td><strong>Категория</strong></td>
                                <td>{getCategoryName(bike1.category)}</td>
                                <td>{getCategoryName(bike2.category)}</td>
                            </tr>
                            <tr>
                                <td><strong>В наличии</strong></td>
                                <td>{bike1.stock} шт.</td>
                                <td>{bike2.stock} шт.</td>
                            </tr>
                            <tr>
                                <td><strong>Описание</strong></td>
                                <td>{bike1.description.substring(0, 80)}...</td>
                                <td>{bike2.description.substring(0, 80)}...</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div className="compare-winner">
                        <strong>Результат сравнения:</strong><br/>
                        {bike1.price < bike2.price && (
                            <span className="winner">{bike1.name} дешевле на {(bike2.price - bike1.price).toLocaleString()} ₽</span>
                        )}
                        {bike2.price < bike1.price && (
                            <span className="winner">{bike2.name} дешевле на {(bike1.price - bike2.price).toLocaleString()} ₽</span>
                        )}
                        {bike1.price === bike2.price && (
                            <span className="winner">Цены одинаковые</span>
                        )}
                        {bike1.stock > bike2.stock && (
                            <div>{bike1.name} больше в наличии ({bike1.stock} шт.)</div>
                        )}
                        {bike2.stock > bike1.stock && (
                            <div>{bike2.name} больше в наличии ({bike2.stock} шт.)</div>
                        )}
                    </div>
                </div>
            )}
        </div>
    );
}

export default BikeCompare;