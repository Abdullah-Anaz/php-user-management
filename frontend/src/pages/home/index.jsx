import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import DataTable from "react-data-table-component";
import { PencilSquareIcon, TrashIcon } from "@heroicons/react/24/outline";
import "./index.css";

function Home() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [searchText, setSearchText] = useState("");

  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = () => {
    setLoading(true);
    axios
      .get(`${process.env.REACT_APP_BASE_URL}/routes.php?action=getAllUsers`)
      .then((res) => {
        setUsers(res.data.userlist);
      })
      .catch((err) => {
        console.log(err);
      })
      .finally(() => {
        setLoading(false);
      });
  };

  const deleteUser = (id) => {
    if (window.confirm("Are you sure?")) {
      axios
        .delete(
          `${process.env.REACT_APP_BASE_URL}/routes.php?action=deleteUser`,
          {
            data: { user_id: id },
          }
        )
        .then((res) => {
          fetchUsers();
        })
        .catch((err) => {
          console.log(err);
        });
    }
  };

  const handleSearch = (value) => {
    setSearchText(value);
  };

  const filteredUsers = searchText
    ? users.filter(
        (user) =>
          user.user_id.toString().includes(searchText) ||
          user.name.toLowerCase().includes(searchText.toLowerCase()) ||
          user.email.toLowerCase().includes(searchText.toLowerCase()) ||
          user.date.toLowerCase().includes(searchText.toLowerCase())
      )
    : users;

  const columns = [
    {
      name: "#ID",
      selector: (row) => row.user_id,
      sortable: true,
    },
    {
      name: "Name",
      selector: (row) => row.name,
      sortable: true,
    },
    {
      name: "Email",
      selector: (row) => row.email,
      sortable: true,
    },
    {
      name: "Created Date",
      selector: (row) => row.date,
      sortable: true,
    },
    {
      name: "ACTION",
      cell: (row) => (
        <div className="d-flex gap-1 flex-wrap mt-1 mb-1">
          <Link
            to={`/edit/${row.user_id}`}
            className="btn btn-primary text-uppercase"
          >
            <PencilSquareIcon className="icon" />
          </Link>

          <button
            onClick={() => deleteUser(row.user_id)}
            className="btn btn-danger text-uppercase"
          >
            <TrashIcon className="icon" />
          </button>
        </div>
      ),
    },
  ];

  return (
    <div className="crud-container">
      <h3 className="my-3">Manage Users</h3>

      <div className="d-flex mb-2">
        <Link to="/insert" className="btn btn-primary text-uppercase">
          Add User
        </Link>
        <input
          type="text"
          className="form-control ms-2"
          placeholder="Search..."
          value={searchText}
          onChange={(e) => handleSearch(e.target.value)}
        />
      </div>

      <DataTable
        columns={columns}
        data={filteredUsers}
        progressPending={loading}
        striped
        highlightOnHover
        pointerOnHover
        noHeader
        pagination
        paginationPerPage={10}
      />
    </div>
  );
}

export default Home;
