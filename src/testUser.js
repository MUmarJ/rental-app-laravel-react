const Request = require("superagent");

const BASE_URL = "http://localhost:8000";

const testUser = {
  name: "test",
  redirect: "http://localhost:8000/",
};

// Request.post(`${BASE_URL}/oauth/clients`, testUser).end((e, res) => {
//   console.log(res.data);
// });

Request.get(`${BASE_URL}/oauth/clients`).end((e, res) => {
  console.log(res.data);
});
