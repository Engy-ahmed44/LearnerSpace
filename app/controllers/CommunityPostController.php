<?php

namespace App\Controllers;

use App\Auth\AuthManager;
use App\Core\Controller;
use App\Core\ControllerHelpers;
use App\DB\Entity\CommunityPost;
use App\View\CommunityPost\CommunityPostView;
use App\DB\Repository\CommunityPostRepository;
use App\View\Common\BaseSkeletonView;
use App\View\CommunityPost\CommunityPostsView;
use App\View\CommunityPost\CreateCommunityPostView;
use App\View\CommunityPost\ViewCommunityPostView;

class CommunityPostController extends Controller
{
    private $communityPostRepository;

    public function __construct()
    {
        $this->communityPostRepository = CommunityPostRepository::get();
    }

    public function index()
    {
        // Fetch all community posts
        $posts = $this->communityPostRepository->findAll();

        $baseView = new CommunityPostsView($posts);
        (new BaseSkeletonView("Posts", $baseView))->render();
    }

    public function view($postId)
    {
        // Fetch the post by ID
        $post = $this->communityPostRepository->find($postId);

        $baseView = new ViewCommunityPostView($post);
        (new BaseSkeletonView($post->getTitle(), $baseView))->render();
    }


    // Display the form to create a new post
    public function create(): void
    {
        $baseView = new CreateCommunityPostView();
        (new BaseSkeletonView("Create Post", $baseView))->render();
    }

    // Handle form submission for creating a new post
    public function store(): void
    {
        // Check if the request is a POST
        if (ControllerHelpers::isPost()) {
            // Get sanitized input data using ControllerHelpers
            $title = ControllerHelpers::post('title');
            $content = ControllerHelpers::post('content');

            // Validation: Basic validation for title and content
            if (empty($title) || empty($content)) {
                // Redirect back or display an error message
                echo "Title and content are required.";
                return;
            }

            // Find the user by ID
            $user = AuthManager::getInstance()->getUser();
            if (!$user) {
                echo "User not found!";
                return;
            }

            // Create a new CommunityPost entity
            $post = new CommunityPost($title, $content, $user);

            CommunityPostRepository::get()->create($post);

            // Redirect or display success message
            echo "Post created successfully!";
        }
    }
}
