const express = require('express');
const Product = require('../models/product');
const router = express.Router();

router.get('/', async (req, res) =>{
    try {
        const products = await Products.find();
        res.json(products);
    } catch (error){
        res.status(500).json({ message: error.message});
    }
});
router.post('/', async (req, res) =>{
const { name, descripton, price, imageUrl } = req.body;
const newProduct = new Product({
    name,
    descripton,
    price,
    imageUrl
});
try {
    const savedProduct = await newProduct.save();
    res.status(201).json(savedProduct);
} catch (error) {
    res.status(400).json({message: error.message});
}
});
 module.exports = router;