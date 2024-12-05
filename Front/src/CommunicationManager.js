let laravel = { URL: 'http://localhost:8000' }
export async function getPublicacions() {

    const URL = `${laravel.URL}/api/show`
    const response = await fetch(URL);

    if (!response.ok) {
        throw new Error(`Error en solicitud`);
    }
    const json = await response.json();
    return json;
}

