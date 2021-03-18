<?php

declare(strict_types=1);

namespace FUNC;

require_once('config.php');

use const CONFIG\HOST, CONFIG\DBNAME, CONFIG\USER, CONFIG\PASS;

require_once('database.php');

use ROOT\INC\DB\Database;

$my_db = new Database(HOST, DBNAME);
$my_db->connect(USER, PASS);

function get_posts(string $on_page): array
{
  global $my_db;
  define('PER_PAGE', 3);
  $total_pages = $my_db->fetch("SELECT CEILING(COUNT(*)/?) AS pages FROM posts", [PER_PAGE]);
  $total_pages = iterator_to_array($total_pages)[0]['pages'];
  $from = ($on_page - 1) * PER_PAGE;
  $posts = $my_db->fetch("SELECT * FROM posts ORDER BY id DESC LIMIT ?, ?", [$from, PER_PAGE]);
  return ['total_pages' => $total_pages, 'posts' => $posts];
}

function get_post(string $post): array
{
  global $my_db;
  $post = $my_db->fetch("SELECT * FROM posts WHERE slug = ?", [$post]);
  return iterator_to_array($post)[0];
}

function login_request(): string
{
  return $_SESSION['login'] = base64_encode(bin2hex(random_bytes(24)));
}

function csrf_verify(string $form_token, string $session_token): bool
{
  if ($form_token === $session_token) {
    return true;
  }
  return false;
}

function verify_user($email, $password): bool
{
  global $my_db;
  $user = $my_db->fetch("SELECT * FROM users WHERE email = ?", [$email]);
  $user = (iterator_to_array($user))[0];
  if (password_verify($password, $user['hash'])) {
    return true;
  }

  return false;
}

function delete_post(string $id): bool
{
  global $my_db;
  $stmt = $my_db->execute("DELETE FROM posts WHERE id=? LIMIT 1", [$id]);
  return true;
}

function edit_request(): string
{
  return $_SESSION['edit'] = base64_encode(bin2hex(random_bytes(24)));
}

function edit_post(int $id): array
{
  global $my_db;
  $result = $my_db->fetch("SELECT * FROM posts WHERE id=? LIMIT 1", [$id]);
  return iterator_to_array($result)[0];
}

function update_post(string $title, string $content, string $id): bool
{
  global $my_db;
  $stmt = $my_db->execute("UPDATE posts SET title = ?, slug = ?, content = ? WHERE id=?;", 
    [$title, str_replace(' ', '-', strtolower($title)), $content, $id]);
  return true;
}

/**
 *  for debugging
 * 
 */
function dd($data, array $options = []): void
{
  $defaultOptions = [
    'detailed'  => false,
  ];

  $options = array_merge($defaultOptions, $options);

  echo "<style>
  pre {
    background: #fdf6e3; 
    color: #657b83; 
    padding: 1rem; 
    font-size: 0.9rem; 
    line-height: 1.3rem;
    font-family: monospace;
  }
  
  pre pre {
    padding: 0;
  }

  pre .xdebug-var-dump {
    font-size: 0.8rem;
  }
  </style>";

  echo "<pre>";
  ($options['detailed']) ? var_dump($data) : print_r($data);
  echo '</pre>';

  exit();
}
