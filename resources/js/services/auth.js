const axios = window.axios;
const registerService = async (data) => {
    const res = await axios.post("/register", data);
    if (res.data.accessToken) {
        window.axios.defaults.headers[
            "Authorization"
        ] = `Bearer ${res.data.accessToken}`;
        localStorage.setItem("token", res.data.accessToken);
    }
    return res.data;
};

const loginService = async (data) => {
    const res = await axios.post("/login", data);
    if (res.data.accessToken) {
        window.axios.defaults.headers[
            "Authorization"
        ] = `Bearer ${res.data.accessToken}`;
        localStorage.setItem("token", res.data.accessToken);
    }
    return res.data;
};

export { registerService, loginService };
