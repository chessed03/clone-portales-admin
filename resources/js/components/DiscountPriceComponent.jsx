import React, { useState }  from "react";
import ReactDOM from 'react-dom/client';

export default function DiscountPriceComponent(props) {

    const dataHasCost = document.getElementById('discount-price-component').getAttribute('data-has_cost');
    const dataInputValuePrice = document.getElementById('discount-price-component').getAttribute('data-input_value_price');
    const dataSelectValueDiscount = document.getElementById('discount-price-component').getAttribute('data-select_value_discount');
    const convertedValue = isNaN(parseInt(dataHasCost, 10)) ? 0 : parseInt(dataHasCost, 10);
    const [showDiv, setShowDiv] = useState( (convertedValue == 0) ? false : true );
    const [radioOption, setRadioOption] = useState((convertedValue) ? 'show' : 'hide');
    const [inputValue, setInputValue] = React.useState(dataInputValuePrice);
    const [selectedOption, setSelectedOption] = useState( (dataSelectValueDiscount == '') ? 'DEFAULT' : dataSelectValueDiscount );
    console.log(dataHasCost)

    const handleRadioChangeCost = (e) => {

        setShowDiv(e.target.value === 'show');

        setRadioOption(e.target.value);

        $('#input_has_cost').val( (e.target.value === 'show') ? 1 : 0 );

    };

    const handleInputChange = (e) => {

        setInputValue(e.target.value);

        $('#input_value_price').val(e.target.value);

    };
    const handleSelectChangeDiscount = (e) => {

        setSelectedOption(e.target.value);

        $('#select_value_discount').val(e.target.value);

    };

    return (

        <div className="row">

            <div className="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                <label>Tiene costo?</label>
            </div>

            <div className="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
            <label>
                <input type="radio" name="showHide" value="show" onChange={handleRadioChangeCost} checked={radioOption === 'show'}/>
                &nbsp;&nbsp;Sí
            </label>
                &nbsp;&nbsp;&nbsp;&nbsp;
            <label>
                <input type="radio" name="showHide" value="hide" onChange={handleRadioChangeCost} checked={radioOption === 'hide'}/>
                &nbsp;&nbsp;No
            </label>
            </div>
            {showDiv && <div className="col-sm-6 col-md-6 col-lg-6 col-xl-6 form-group">
                <label htmlFor="component-price">Precio:</label>
                <input type="number" id="component-price" className="form-control" value={inputValue} onChange={handleInputChange} />
            </div>}

            {showDiv && <div className="col-sm-6 col-md-6 col-lg-6 col-xl-6 form-group">
                <label htmlFor="discount">Descuento:</label>
                <select id="component-discount" className="form-control" value={selectedOption} onChange={handleSelectChangeDiscount}>
                    <option value="DEFAULT" disabled>Selecciona una opción</option>
                    <option value=".1">10 %</option>
                    <option value=".15">15 %</option>
                    <option value=".3">30 %</option>
                    <option value=".5">50 %</option>
                </select>
            </div>}
        </div>

    );

}

if (document.getElementById('discount-price-component')) {

    ReactDOM.createRoot( document.getElementById('discount-price-component') ).render(<DiscountPriceComponent/>)

}
