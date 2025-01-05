import { API_HOST } from "./constants.js";

class Api {

    static prefix = '/api';

    static async get(uri) {
        let res = null

        try {
            const req = await fetch(`${API_HOST}${this.prefix}/${uri}`)
            res = await req.json()
        } catch (error) {
            console.log(error)
        }

        return res
    }

    static async post(uri, data = {}) {
        let res = null

        try {
            const req = await fetch(`${API_HOST}${this.prefix}/${uri}`, {
                method: 'POST',
                body: JSON.stringify(data)
            })
            res = await req.json()
        } catch (error) {
            console.log(error)
        }

        return res
    }

    static async getUsers() {
        return await this.get('users')
    }

    static async getUser(id) {
        return await this.get(`user/${id}/info`)
    }

    static async createUser(data) {
        return await this.post('user/create', {
            action: 'create',
            data: data
        })
    }

    static async updateUser(id, data) {
        return await this.post(`user/update`, {
            action: 'update',
            id: id,
            data: data
        })
    }

    static async destroyUser(id) {
        return await this.post('user/destroy', {
            id: id
        })
    }

    static async getProducts() {
        return await this.get('products')
    }

    static async getProduct(id) {
        return await this.get(`product/${id}/info`)
    }

    static async createProduct(data) {
        return await this.post('product/create', {
            action: 'create',
            data: data
        })
    }

    static async updateProduct(id, data) {
        return await this.post('product/update', {
            action: 'update',
            id: id,
            data: data
        })
    }

    static async destroyProduct(id) {
        return await this.post('product/destroy', {
            id: id
        })
    }

    static async getIngredients() {
        return await this.get('ingredients')
    }

    static async getIngredient(id) {
        return await this.get(`ingredient/${id}/info`)
    }

    static async createIngredient(data) {
        return await this.post('ingredient/create', {
            action: 'create',
            data: data
        })
    }

    static async updateIngredient(id, data) {
        return await this.post('ingredient/update', {
            action: 'update',
            id: id,
            data: data
        })
    }

    static async destroyIngredient(id) {
        return await this.post('ingredient/destroy', {
            id: id
        })
    }
}

export default Api