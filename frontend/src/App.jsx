import PopularSlider from './components/PopularSlider';
import BikeCompare from './components/BikeCompare';

function App() {
    return (
        <div style={{ maxWidth: '1000px', margin: '0 auto', padding: '20px' }}>
            <h1 style={{ color: '#00ff9d' }}>Велосипеды</h1>
            <PopularSlider />
            <BikeCompare />
        </div>
    );
}

export default App;