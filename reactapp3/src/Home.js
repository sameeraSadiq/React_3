// src/Home.js
import React, { useEffect, useState } from 'react';
import './Home.css'; // Ensure you have the corresponding CSS styles

const Home = () => {
    const [posts, setPosts] = useState([]);

    useEffect(() => {
        fetch('http://localhost/afternoonPHP 12-1/reactapp3/getPosts.php')
            .then(response => response.json())
            .then(data => setPosts(data));
    }, []);

    return (
        <div className="container">
            <h2>Posts</h2>
            <div className="posts-grid">
                {posts.map((post) => (
                    <div className="card" key={post.id}>
                        <h3>{post.title}</h3>
                        <p className="author-date">by {post.author} on {post.date}</p>
                        <a className="read-more" href={`/posts/${post.id}`}>Read More</a>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Home;