import { SearchOutlined } from "@ant-design/icons";
import "./searchComponent.scss";
import { Input } from 'antd';

const { Search } = Input;

const SearchComponent = () => {

  return (
    <div className='search'>
      <Search
        placeholder="Tìm kiếm..."
        enterButton={<SearchOutlined />}
        size="large"
      />
    </div>
  );
};

export default SearchComponent;
