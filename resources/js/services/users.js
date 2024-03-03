const axios = window.axios;

const logoutService = async () => {
    const res = await axios.post("/logout");
    return res;
};

const updateUserService = async (data) => {
    const res = await axios.patch(`/users/${data.id}`, { data: data.val });
    return res;
};

const deleteUserServece = async (id) => {
    const res = await axios.delete(`/users/${id}`);
    return res;
};

const cleanCatchService = async (id) => {
    const res = await axios.get(`/settings`);
    return res;
};

export { cleanCatchService, updateUserService, deleteUserServece };
