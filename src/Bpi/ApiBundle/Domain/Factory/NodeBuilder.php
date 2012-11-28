<?php
namespace Bpi\ApiBundle\Domain\Factory;

use Bpi\ApiBundle\Domain\Aggregate\Node;
use Bpi\ApiBundle\Domain\Entity\Profile;
use Bpi\ApiBundle\Domain\Entity\Resource;
use Bpi\ApiBundle\Domain\Entity\Author;
use Bpi\ApiBundle\Domain\Aggregate\Agency;
use Bpi\ApiBundle\Domain\ValueObject\AgencyId;

class NodeBuilder
{
	protected $author;
	protected $profile;
	protected $resource;

	/**
	 * 
	 * @param \Bpi\ApiBundle\Domain\Entity\Profile $profile
	 * @return \Bpi\ApiBundle\Domain\Factory\NodeBuilder
	 */
	public function profile(Profile $profile)
	{
		$this->profile = $profile;
		return $this;
	}
	
	/**
	 * 
	 * @param Resource $resource
	 * @return \Bpi\ApiBundle\Domain\Factory\NodeBuilder
	 */
	public function resource(Resource $resource)
	{
		$this->resource = $resource;
		return $this;
	}
	
	/**
	 * 
	 * @param Author $author
	 * @return \Bpi\ApiBundle\Domain\Factory\NodeBuilder
	 */
	public function author(Author $author)
	{
		$this->author = $author;
		return $this;
	}
	
	/**
	 * 
	 * @return \Bpi\ApiBundle\Domain\Aggregate\Node
	 * @throws \RuntimeException
	 */
	public function build()
	{
		if (is_null($this->author))
			throw new \RuntimeException('Invalid state: Author is required');
		
		if (is_null($this->profile))
			throw new \RuntimeException('Invalid state: Profile is required');
		
		if (is_null($this->resource))
			throw new \RuntimeException('Invalid state: Resource is required');
		
		return new Node($this->author, $this->resource, $this->profile);
	}
}