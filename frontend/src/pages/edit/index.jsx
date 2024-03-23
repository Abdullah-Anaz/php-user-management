import React, { useEffect, useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import "./index.css";
import { useParams } from "react-router-dom";
import Form from "common/form";

function EditUserForm() {
  const { id } = useParams();
  const navigate = useNavigate();

  const [user, setUser] = useState({ name: "", email: "" });
  const [loading, setLoading] = useState(true);

  const onChangeValue = (e) => {
    setUser({ ...user, [e.target.id]: e.target.value });
  };

  useEffect(() => {
    axios
      .get(
        `${
          process.env.REACT_APP_BASE_URL
        }routes.php?action=getUser&user_id=${parseInt(id)}`
      )
      .then((res) => {
        setUser({ name: res.data.user.name, email: res.data.user.email });
      })
      .catch((err) => {
        console.log(err);
      })
      .finally(() => {
        setLoading(false);
      });
  }, [id]);

  const editUser = (e) => {
    e.preventDefault();
    axios
      .put(`${process.env.REACT_APP_BASE_URL}/routes.php?action=editUser`, {
        ...user,
        user_id: parseInt(id),
      })
      .then((res) => {
        navigate("/");
      })
      .catch((err) => {
        console.log(err);
      });
  };

  return (
    <div className="form-container insert-form">
      <h2>Edit User</h2>
      {loading && <p>Loading...</p>}
      {!loading && (
        <Form
          onSubmit={editUser}
          onChangeValue={onChangeValue}
          user={user}
          btnText="Edit User"
        />
      )}
    </div>
  );
}

export default EditUserForm;
